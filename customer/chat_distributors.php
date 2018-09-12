<script>
   let currDistId = null, currDistName = null;
</script>
<?php
   if (isset($_GET['chat_dist'])) {
   	
   
   ?>
<div class="table-title">
   <h3 style="text-align: center;">ЧАТ И ДистрибьюторОМ</h3>
</div>
<table class="table-fill" >
   <thead>
      <tr style="height: 50px;">
         <th class="text-left">Дистрибьютор</th>
         <th class="text-left"></th>
      </tr>
   </thead>
   <tbody class="table-hover">
      <?php 
         include("../inc/db.php");
         
         
         	if (isset($_SESSION['customer_id'])) {
         
         	
         
         // this is for customer details
         		$customer_id = $_SESSION['customer_id'];
         
         		$onscreen_status = 'Отправил';
         
         		$i = 0;
         
         
         		$sql = "select 
         		                        
         					distinct com.name as company_name
         
         				from 
         					cart c
         					join product_item pt on pt.cart_id = c.id
         					join simple_order so on so.cart_id = pt.cart_id
         					join product p on p.id = pt.product_id
         					join distributor d on d.id = p.distributor_id
         					join company com on com.id = d.company_id
         					join customer cc on cc.id = c.customer_id
         
         				where c.customer_id = '$customer_id'  ";
         
         
         	
         
         		$run = mysqli_query($con, $sql);
         		$current_distributor_id = null;
         	    $current_company_name = null;
                       while ($rows = mysqli_fetch_array($run)) {
                       	$distributor_name = $rows['company_name'];
         
         	?>
      <tr style="height: 50px;">
         <td class="text-left" ><?php echo $distributor_name; ?></td>
         <td class="text-left" style="width: 100px;">
            <!--chat -->
            <div class="btn-group">
               <button class="btn btn-primary dropdown-toggle btn-lg" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false" style="width: 100px;"
                  onclick="setCurrentValues(<?php echo $distributor_id; ?>, '<?php echo
                     $company_name; ?>')">
               <span class="fa fa-comments pull-left">Chat</span>
               </button>
               <ul class="dropdown-menu pb-chat-dropdown">
                  <li>
                     <div class="panel panel-info pb-chat-panel">
                        <div class="panel panel-heading pb-chat-panel-heading">
                           <div class="row">
                              <div class="col-xs-12">
                                 <a href="#">
                                 <label id="support_label"><?php echo $customer_name; ?></label>
                                 </a>
                                 <a href="#"><span
                                    class="fa fa-cog pull-right pb-chat-top-icons"></span></a>
                                 <a href="#"><span
                                    class="fa fa-share pull-right pb-chat-top-icons"></span></a>
                              </div>
                           </div>
                        </div>
                        <div class="scroll-container" id="chatRoom_<?php echo $distributor_id; ?>">
                           <form action="" method="post">
                              <hr>
                              <div class="clearfix"></div>
                           </form>
                        </div>
                        <div class="panel-footer">
                           <div class="row">
                              <div class="col-xs-10">
                                 <textarea id="message_<?php echo $distributor_id; ?>"
                                    class="form-control pb-chat-textarea"
                                    onkeyup="textAreaOnEnterClick(event, <?php echo
                                       $distributor_id; ?>, '<?php echo $company_name; ?>')"
                                    placeholder="чат...И нажмите Кнопку Enter"
                                    style="width: 200px;"></textarea>
                              </div>
                           </div>
                        </div>
                     </div>
                  </li>
               </ul>
            </div>
            <!--chat end-->
         </td>
      </tr>
      <?php } }?>
   </tbody>
</table>
<?php } ?>
<script>
   function setCurrentValues(distributorId, distributorName) {
   	currDistId = distributorId;
   	currDistName = distributorName;
   	loadChat();
   }
   
   function textAreaOnEnterClick(event) {
   	if (event.which === 13) {
   		let textArea = document.getElementById('message_' + currDistId);
   
   		if (textArea == null) {
   			console.log('TextArea is not found');
   			return;
   		}
   
   		let message = {
   			'distributor_id': currDistId,
   			'message': textArea.value,
   			'customer_id' : <?php echo $_SESSION["customer_id"]; ?>
   		};
   
   		let data = JSON.stringify(message);
   
   		$.ajax({
   			method: 'POST',
   			url: 'handlers/requests_handler.php?action=send_message_to_distributor',
   			data: data,
   			success: function () {
   				loadChat();
   			},
   			error: function (error) {
   				console.log(error);
   			}
   		});
   
   		textArea.value = '';
   	}
   }
   
   $(document).ready(function () {
   	loadChat();
   });
   
   //showing all chat in box
   
   function loadChat() {
   	if (currDistId == null) return;
   	let customerId = '<?php echo $_SESSION["customer_id"]; ?>' ;
   	let customerName = '<?php echo $_SESSION["customer_name"]; ?>';
   
   	if (customerId == undefined && customerName == undefined) return;
   
   	$.ajax({
   		method: 'GET',
   		url: 'handlers/requests_handler.php?action=get_chat&customer_id=' + customerId
   		+ '&customer_name=' + customerName
   		+ '&distributor_id=' + currDistId
   		+ '&distributor_name=' + currDistName,
   		success: function (data) {
   			let chatRoom = document.getElementById('chatRoom_' + currDistId);
   			if (chatRoom != null) chatRoom.innerHTML = data;
   		},
   		error: function () {
   			console.log('error');
   		}
   	});
   }
   
   setInterval(function () {
   	loadChat();
   }, 2000);
</script>