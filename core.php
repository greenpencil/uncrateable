<?php
class core {
    private $db;
 
    function __construct() {
		$dbHost = "127.0.0.1";
		$dbUser = "root";
		$dbPassword = "";
		$dbName = "uncrateable";
		
        $this->db = new PDO('mysql:host='.$dbHost.';dbname='.$dbName, $dbUser, $dbPassword);
		
    }

    function __destruct() {
        $db = null;
    }
	
	function loaditemprices()
	{
		// Function loads the item prices from the json files below and inserts them into the database
		$prices = json_decode(file_get_contents("./data/prices.json"),true);

		foreach($prices as $item) 
		{
			$ids = array_keys($item['prices']);
			foreach ($ids as $id) {
			$itemname = $item['prices'][$id]['item_info']['item_name'];
				if (isset($item['prices'][$id]['11']))
				{
					$value = $item['prices'][$id]['11']['0']['current']['value'];
					$currency = $item['prices'][$id]['11']['0']['current']['currency'];
				}else if(isset($item['prices'][$id]['6']['0'])){
					$value = $item['prices'][$id]['6']['0']['current']['value'];
					$currency = $item['prices'][$id]['6']['0']['current']['currency'];
				} else {
					$value = '0';
					$currency = 'metal';
				}
				$query = $this->db->prepare("INSERT INTO prices (`id`,`name`,`price`,`currency`) VALUES (:id, :name, :value, :currency)");
				$query->execute(array(':id' => $id, ':name' => $itemname, ':value' => $value, ':currency'=> $currency));
			}
		}
	}
	
	function loaditemimages()
	{
		// Function that grabs the image details for weapons via Valves API
		$itemlist = json_decode(file_get_contents("./data/items.json"),true);
	}
	
	function getcrate($number)
	{
		// Function gets the crate contents
		$query = $this->db->query('select * from itemlist where crateno = '.$number);
		$result = array();
		
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$result[] = array(
				"id" => $row['id'], 
				"item" => $row['item'], 
				"crateno" => $row['crateno'],
				"percentage" => $row['percentage']
		);
		}
		
		return $result;
	}
	
	function getitem($name)
	{
	// Function gets item information
		$query = $this->db->query('select * from prices where name = "'.$name.'"');
		$result = array();
		
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$result[] = array(
				"id" => $row['id'], 
				"name" => $row['name'], 
				"price" => $row['price'],
				"currency" => $row['currency'],
				"image" => $row['image']
		);
		}
		return $result;
	}
	
	function getcrateprices($crateno)
	{
		$query = $this->db->query('select itemlist.item, prices.price, prices.currency, itemlist.percentage from itemlist, prices where itemlist.item = prices.name and crateno = '.$crateno);
		$result = array();
		
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$result[] = array(
				"name" => $row['name'], 
				"price" => $row['price'],
				"currency" => $row['currency'],
				"percentage" => $row['percentage']
		);
		}
		return $result;
	}
	
	function gethighestcrates()
	{
		$query = $this->db->query('select * from cratelist order by value desc limit 15');
		$result = array();
		
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$result[] = array(
				"name" => $row['name'], 
				"userrating" => $row['userrating'],
				"value" => $row['value']
		);
		}
		return $result;
	}

	
	function createmodal($crateno)
	{
		$query = $this->db->query('select * from cratelist WHERE id = '.$crateno);
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
			echo '
  <div class="modal fade" id="crate-'.$row['id'].'">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">'.$row['name'].'</h4>
        </div>
        <div class="modal-body">
          <img src="./assets/img/'.$row['image'].'" height="200" class="img-rounded" align="left">
			<div class="glance">
			<p><b>This Crate at a glance</b><br/>
			Average crate value: '.$row['value'].'<img src="./assets/img/metal.png" height="20"><br/>
			Cost on Steam Market Place: no data<br/>
			User Ratings: '.$row['userrating'].'<br/>
			Highest Value Item: no data<br/>
			Lowest Value Item: no data<br/>
			</p>
			</div>
			
			<div>
			<p><b>Description</b><br/>
			'.$row['desc'].'<br/></p>
			</div>
			
			<div>
			<p><b>Contains</b>
			<table class="table table-bordered">
			<thead>
                <tr>
                  <th>Image</th>
				  <th>Item Name</th>
                  <th>Price</th>
                </tr>
            </thead>
			<tbody>';
			$items = $this->getcrate($row['id']);
			foreach ($items as $item)
			{
				$iteminfo = $this->getitem($item['item']);
				echo '<tr>
				<td><img src="'.$iteminfo[0]['image'].'" height="100"></td>
				<td>'.$item['item'].'</td>';
				
				echo'<td>'.$iteminfo[0]['price'];
				echo' <img src="./assets/img/'.$iteminfo[0]['currency'].'.png" height="40"></td>
				</tr>';
			}
			
			
			echo'
			</tbody>
			
			</table>
			</p>
			</div>
			
			</div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>';
			$cratedetail = $this->getcrate($crateno);			
			foreach ($cratedetail as $iteminfo)
			{
			echo '';
			}
		}
	}
	
	function createcratedropdown()
	{
		$query = $this->db->query('select * from cratelist');
		echo "<form method='get' action=''>";
		echo "<select class='form-control' name='crate' placeholder='Please Select a Crate'>";
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
			echo "<option value='".$row['id']."'>".$row['name']."</option>";
		}
		echo "</select><br/><center><button type='submit' class='btn btn-primary '>Submit</button></center>";
		echo "</form>";
	}
	
	function createtopcrates()
	{
		echo '<table class="table table-bordered"><thead><tr><th></th><th>Crate Number</th><th>Value</th><th>Info</th></tr></thead><tbody><tr>';
		$query = $this->db->query('select * from cratelist ORDER BY value desc limit 15');
		$array = array();
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                  echo'<td><img src="./assets/img/'.$row['image'].'" width="100" height="100"></td>';
                  echo '<td>'.$row['name'].'</td>';
                  echo '<td>'.$row['value'].' ref (<img src="./assets/img/metal.png" height="30">)</td>';
                  echo '<td><p><a href="#crate-'.$row['id'].'" role="button" class="btn btn-primary" data-toggle="modal">More Info</a></p></td></tr>';
				  $array[] = array (
				  "id" => $row['id'],
				  );
                }
        echo "</tbody></table>";
		foreach ($array as $detail)
		{
			$this->createmodal($detail['id']);	
		}
	}
	
	function createyourcrate($id)
	{
		echo '<table class="table table-bordered"><thead><tr><th></th><th>Crate Number</th><th>Value</th><th>Info</th></tr></thead><tbody><tr>';
		$query = $this->db->query('select * from cratelist WHERE id = '.$id);
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                  echo'<td><img src="./assets/img/'.$row['image'].'" width="100" height="100"></td>';
                  echo '<td>'.$row['name'].'</td>';
                  echo '<td>'.$row['value'].' ref (<img src="./assets/img/metal.png" height="30">)</td>';
                  echo '<td><p><a href="#crate-'.$id.'" role="button" class="btn btn-primary" data-toggle="modal">More Info</a></p></td></tr>';
                }
				
        echo "</tbody></table>";
		$this->createmodal($id);
	}
	
	function calccrateaverage($crate)
	{
		$query = $this->db->query('select itemlist.item, prices.price, prices.currency, itemlist.percentage from itemlist, prices where itemlist.item = prices.name and crateno = '.$crate);
		$row_count = $query->rowCount();

		$total = 0;
		
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
			if($row['currency'] == "keys")
			{
				$value = $row['price'] * 5.33;
			}
			else if($row['currency'] == "earbuds")
			{
				$value = $row['price'] * 117.26;
			}
			else{
				$value = $row['price'];
			}
			$total = $total + $value;
		}
		$total = $total / $row_count;
		$total = number_format($total, 2);
		
		$query = $this->db->prepare("UPDATE cratelist set `value` = :value where id = :crate;");
		$query->execute(array(':value' => $total, ':crate' => $crate));
		
		return $total;
	}
}
?>