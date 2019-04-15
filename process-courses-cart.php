<?php
include_once('sys/core/init.inc.php');
$common = new common();

// Load Procedures to Cart
if (!empty($_POST["action"])) {
 
switch ($_POST["action"]) {
        case "add":
            if (!empty($_POST["quantity"] > 0)) {
                $productByCode = $common->GetRows("SELECT TSP.* FROM tbl_courses TSP WHERE id = '{$_POST["ItemID"]}' "); // Run the Above Select Query
                if($productByCode){
                    $itemArray = array($productByCode[0]["systemPCode"] => array('courseName' => $productByCode[0]["course_name"], 'quantity' => $_POST["quantity"],  'ProcedureCharges' => $productByCode[0]['course_price'], 'systemPCode' => $productByCode[0]["systemPCode"], 'id' => $productByCode[0]["id"]));
                   
                   if (!empty($_SESSION["coursesCartItems"])) {
                        if (in_array($productByCode[0]["systemPCode"], $_SESSION["coursesCartItems"])) {
                            foreach ($_SESSION["coursesCartItems"] as $k => $v) {
                                if ($productByCode[0]["systemPCode"] == $k)
                                    $_SESSION["coursesCartItems"][$k]["quantity"] = $_POST["quantity"];
                                }
                        } else {
                                $_SESSION["coursesCartItems"] = array_merge($_SESSION["coursesCartItems"], $itemArray);
                        }
                    } else {
                        $_SESSION["coursesCartItems"] = $itemArray;
                    }
                }
            }
            break;

        case "remove":
            if (!empty($_SESSION["coursesCartItems"])) {
                foreach ($_SESSION["coursesCartItems"] as $gicode => $vcartitem){
                    $GetItemCode = $common->CCGetDBValue("SELECT systemPCode FROM tbl_courses WHERE id ='{$_POST["ItemID"]}' ");
                    // echo $GetItemCode;
                    if ($GetItemCode == $gicode){
                        unset($_SESSION["coursesCartItems"][$gicode]);
                    }
                    if (empty($_SESSION["coursesCartItems"])){
                        unset($_SESSION["coursesCartItems"]);
                    }
                }
            }
            break;
        case "empty":
            unset($_SESSION["coursesCartItems"]);
            break;
    }
} 
$FinalTotal = 0;
$MyCartProducts = count($_SESSION["coursesCartItems"]);
?>
<div class="well well-sm" id="leftdiv">
    <div id="lefttop" style="margin-bottom:5px;">
      <div class="form-group" style="margin-bottom:5px;">
        <div style="clear:both;"></div>
      </div>
    </div>
      <div id="totaldiv">
        <table class="table table-striped table-condensed table-hover list-table" style="margin-bottom:10px;">
            <thead>
              <tr class="success">
                <th>Procedure</th>
                <th style="width: 15%;text-align:center;">Price</th>
                <!-- <th style="width: 15%;text-align:center;">Qty</th> -->
                <th style="width: 20%;text-align:center;">Subtotal</th>
                <th style="width: 20px;" class="satu">
                  <a class="btn btn-danger btn-sm w_full " href="javascript:void(0);" onClick="labTestsCartAction('empty','','')"><i class="fa fa-trash-o"></i> Clear </a>
                </th>
              </tr>
              </thead>
          <tbody>

            <?php
            foreach ($_SESSION["coursesCartItems"] as $item){
                $MyCartProducts = count($_SESSION["coursesCartItems"]);
                $PPrice = $item["ProcedureCharges"];  
                $FinalTotal += ($item["ProcedureCharges"] * $item["quantity"]);
            ?>
                <tr class="responds hide_this_LabTesttrow_<?php echo $item["id"]; ?>">
                    <td><?php echo $item["courseName"]; ?></td> 
                    <td style="width: 15%;"><center><?php echo number_format($item["ProcedureCharges"], 2); ?></center></td>
                    <!-- <td style="width: 15%;"><center><?php echo $item["quantity"]; ?></center></td> -->
                    <td style="width: 20%;"><center><?php echo number_format($item["ProcedureCharges"]*$item["quantity"],2); ?></center></td>
                    <td  style="width: 20px;" class="satu">
                        <center><a onClick="labTestsCartAction('remove', '<?php echo $item["id"]; ?>', '')" class="btn-lg" href="javascript:void(0);" style="margin: 0 auto;"><i class="fa fa-trash-o"></i></a>
                        </center>
                    </td>
                </tr>
            <?php
              }
            ?>
            <tr class="info">
              <td width="25%"><b>Total Items</b></td>
              <td class="text-right" style="padding-right:10px;"><span id="count"> <?php echo $MyCartProducts; ?></span></td>
              <td width="25%"><b>Total</b></td>
              <td class="text-right" colspan="2"><span id="total"> <?php echo number_format($FinalTotal,2); ?></span></td>
            </tr>
            <tr class="success">
              <td colspan="3" style="font-weight:bold;">Total Payable</td>
              <td class="text-right" colspan="2" style="font-weight:bold;"><span id="TfootTotals"> <?php echo number_format($FinalTotal, 2); ?></span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="clearfix"></div>
</div>
<script type="text/javascript">
    $('.TotalCoursesAmount').text('<?php echo number_format($FinalTotal, 2); ?>');
    $('#TotalCoursesAmount').val('<?php echo $FinalTotal; ?>');
</script>