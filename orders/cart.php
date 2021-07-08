<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
if (!empty($_GET["action"])) {
	switch ($_GET["action"]) {
		case "add":
			if (!empty($_POST["quantity"])) {
				$productByproduct_id = $db_handle->runQuery("SELECT * FROM product WHERE product_id='" . $_GET["product_id"] . "'");
				$itemArray = array($productByproduct_id[0]["product_id"] => array('product_name' => $productByproduct_id[0]["product_name"], 'product_id' => $productByproduct_id[0]["product_id"], 'quantity' => $_POST["quantity"], 'price' => $productByproduct_id[0]["price"]));

				if (!empty($_SESSION["cart_item"])) {
					if (in_array($productByproduct_id[0]["product_id"], array_keys($_SESSION["cart_item"]))) {
						foreach ($_SESSION["cart_item"] as $k => $v) {
							if ($productByproduct_id[0]["product_id"] == $k) {
								if (empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
						}
					} else {
						$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
					}
				} else {
					$_SESSION["cart_item"] = $itemArray;
				}
			}
			break;
		case "remove":
			if (!empty($_SESSION["cart_item"])) {
				foreach ($_SESSION["cart_item"] as $k => $v) {
					if ($_GET["product_id"] == $k)
						unset($_SESSION["cart_item"][$k]);
					if (empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
				}
			}
			break;
		case "empty":
			unset($_SESSION["cart_item"]);
			break;
	}
}
?>
<HTML>

<HEAD>
	<TITLE>Simple PHP Shopping Cart</TITLE>
	<link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>

<BODY>
	<div class="container">
		<div id="shopping-cart" class="col-lg-6 col-sm-12">
			<div class="txt-heading">Shopping Cart</div>

			<a id="btnEmpty" href="orderform.php?action=empty">Empty Cart</a>
			<?php
			if (isset($_SESSION["cart_item"])) {
				$total_quantity = 0;
				$total_price = 0;
			?>
				<table class="tbl-cart" cellpadding="10" cellspacing="1">
					<tbody>
						<tr>
							<th style="text-align:left;">product_id</th>
							<th style="text-align:left;">Name</th>
							<th style="text-align:right;" width="5%">Quantity</th>
							<th style="text-align:right;" width="10%">Unit Price</th>
							<th style="text-align:right;" width="10%">Price</th>
							<th style="text-align:center;" width="5%">Remove</th>
						</tr>
						<?php
						foreach ($_SESSION["cart_item"] as $item) {
							$item_price = $item["quantity"] * $item["price"];
						?>
							<tr>
								<td><?php echo $item["product_id"]; ?></td>
								<td><?php echo $item["product_name"]; ?></td>
								<td><?php echo $item["quantity"]; ?></td>
								<td><?php echo "$ " . $item["price"]; ?></td>
								<td><?php echo "$ " . number_format($item_price, 2); ?></td>
								<td>
									<a href="orderform.php?action=remove&product_id=<?php echo $item["product_id"]; ?>" class="btnRemoveAction btn btn-danger">Delete</a>
								</td>
							</tr>
						<?php
							$total_quantity += $item["quantity"];
							$total_price += ($item["price"] * $item["quantity"]);
						}
						$idItems[] = array_column($_SESSION["cart_item"], 'product_name');
						?>

						<tr>
							<td colspan="2" align="right">Total:</td>
							<td align="right"><?php echo $total_quantity; ?></td>
							<td align="right" colspan="2"><strong><?php echo "$ " . number_format($total_price, 2); ?></strong></td>
							<td></td>

						</tr>
					</tbody>
				</table>
			<?php
			} else {
			?>
				<div class="no-records">Your Cart is Empty</div>
			<?php
			}
			?>
		</div>

		<div id="product-grid" class="col-lg-6 col-xs-12">
			<div class="txt-heading" style="text-align: center;">Products</div>
			<?php
			$product_array = $db_handle->runQuery("SELECT * FROM product ORDER BY product_id ASC");
			if (!empty($product_array)) {
				foreach ($product_array as $key => $value) {
			?>
					<div class="card-deck">
						<div class="card">
							<form method="post" action="orderform.php?action=add&product_id=<?php echo $product_array[$key]["product_id"]; ?>">
								<div class="product-tile-footer">
									<div style="display: flex;">
										<div class="product-title col"><?php echo $product_array[$key]["product_name"]; ?></div>
										<div class="product-price col"><?php echo "$" . $product_array[$key]["price"]; ?></div>
									</div>
									<div class="cart-action" style="padding-bottom: 10px;">
										<input type="text" class="product-quantity" name="quantity" value="1" size="2" />
										<input type="submit" value="Add to Cart" class="btnAddAction" />
									</div>
								</div>
							</form>
						</div>
					</div>
			<?php
				}
			}
			?>
		</div>
	</div>
	<div>
		<form method="POST" action="makeorder.php">
			<input type="hidden" value="
		<?php
		foreach ($_SESSION["cart_item"] as $item) {
			$product_id = $item["product_id"];
			echo $product_id . ' ';
		}
		?>
		" name="product_id" readonly>
			<input type="hidden" value="
		<?php
		foreach ($_SESSION["cart_item"] as $item) {
			$item_price = $item["quantity"] * $item["price"];
			echo $item_price  . ' ';
		}
		?>
			" name="amount" readonly>
			<input type="hidden" value="
			<?php
			$sql = "SELECT order_id FROM orders ORDER BY order_id DESC LIMIT 1";
			$result = $conn->query($sql);
			if ($result->num_rows >  0) {
				while ($row = $result->fetch_assoc()) {
					echo $row['order_id'];
				}
			}
			?>
			" name="order_id" readonly>
			<input type="hidden" value="
		<?php
		foreach ($_SESSION["cart_item"] as $item) {
			$quantity = $item["quantity"];
			echo $quantity . ' ';
		}
		?>
		" name="order_quantity" readonly>
			<button class="btn btn-primary" name="cartdetails" type="submit">Submit Order</button>
		</form>
	</div>
</BODY>

<style>
	#shopping-cart table {
		width: 100%;
		background-color: #F0F0F0;
	}

	#shopping-cart table td {
		background-color: #FFFFFF;
	}

	.txt-heading {
		color: #211a1a;
		border-bottom: 1px solid #E0E0E0;
		overflow: auto;
	}

	#btnEmpty {
		background-color: #ffffff;
		border: #d00000 1px solid;
		padding: 5px 10px;
		color: #d00000;
		float: right;
		text-decoration: none;
		border-radius: 3px;
		margin: 10px 0px;
	}

	.btnAddAction {
		padding: 5px 10px;
		margin-left: 5px;
		background-color: #efefef;
		border: #E0E0E0 1px solid;
		color: #211a1a;
		float: right;
		text-decoration: none;
		border-radius: 3px;
		cursor: pointer;
	}

	#product-grid .txt-heading {
		margin-bottom: 18px;
	}

	.product-image {
		height: 155px;
		width: 250px;
		background-color: #FFF;
	}

	.clear-float {
		clear: both;
	}

	.demo-input-box {
		border-radius: 2px;
		border: #CCC 1px solid;
		padding: 2px 1px;
	}

	.tbl-cart {
		font-size: 0.9em;
	}

	.tbl-cart th {
		font-weight: normal;
	}

	.product-title {
		margin-bottom: 20px;
	}

	.product-price {
		float: left;
	}

	.cart-action {
		float: right;
	}

	.product-quantity {
		padding: 5px 10px;
		border-radius: 3px;
		border: #E0E0E0 1px solid;
	}

	.product-tile-footer {
		padding: 15px 15px 0px 15px;
		overflow: auto;
	}

	.cart-item-image {
		width: 30px;
		height: 30px;
		border-radius: 50%;
		border: #E0E0E0 1px solid;
		padding: 5px;
		vertical-align: middle;
		margin-right: 15px;
	}

	.no-records {
		text-align: center;
		clear: both;
		margin: 38px 0px;
	}

	.container {
		display: flex;
		width: 100%;
		gap: 20px;
	}

	@media only screen and (max-width: 900px) {
		.container {
			display: block;
		}
	}
</style>

</HTML>