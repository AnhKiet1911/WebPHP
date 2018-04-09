<?php
    $sql = "select * from products ORDER BY proid DESC limit 10";
    $rs = read_db($sql);  
?>

<div class="pro-new">
    <div class="title-pro">
        <h2>Hàng mới</h2>
    </div>
    <form name="frmAddnew" id="frmAddnew" method="POST">
        <input type="hidden" id="txtIDnew" name="txtIDnew"/>
    </form>
    <?php
        if($rs->num_rows > 0)
        {
            while($row = $rs->fetch_assoc())
            {
    ?>
        <div class="couple-item">
            <div class="pro-items">
                <img src="images/products/thumb/<?php echo $row["ImageUrl"];?>" class="pro-img"/>
                <div class="pro-title">
                    <h2><?php echo $row["ProName"];?></h2>
                </div>
                <div class="pro-price"><span class="sp-price"><?php echo number_format($row["Gia"]);?> VNĐ</span></div>
            </div>
            <div class="item-hidden">
                <div class="pro-title">
                    <h2><?php echo $row["ProName"];?></h2>
                </div>
                <div class="pro-price"><span class="sp-price"><?php echo number_format($row["Gia"]);?> VNĐ</span></div>
                <div class="formbtn">
                    <div class="btnProducts">
                        <button type="button" name="btnDetail" class="items-btn"><span><a href="index.php?act=detail&id=<?php echo $row["ProID"]; ?>">CHI TIẾT</a><span></button>
                        <?php
                        if (isAuthenticated() == true) {
                            ?>
                                    <button type="button" name="btnAddcartnew" id="btnAddcartnew" class="items-btn" ><span><a href="javascript:void(0)" class="anewclick" onclick="setIDnews(<?php echo $row["ProID"]; ?>)">MUA HÀNG</a><span></button>
                    <?php             
                        };
                    ?>
                     </div>
                </div>
            </div>
        </div>
    <?php
            }
        }
    ?>
    
</div>
<div class="clr"></div>
<script type="text/javascript"> 
    function setIDnews(id){
        $("#txtIDnew").val(id);
    }
    $(document).ready( function() {
     $('.anewclick').click(function(){
		var idhang = $("#txtIDnew").val();
        var soluonghang = 1;
        var data_addnew = "id="+ idhang + "&soluong=" + soluonghang;
        $.ajax({
           url:"pages/add_cart.php",
           type:"POST",
           data:data_addnew,
           success: function (data_succ) {
                if(data_succ == "true"){
                    location.reload();
                }
            }
        });
        return false;
    });
 });
</script>