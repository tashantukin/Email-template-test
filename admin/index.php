<!-- begin header -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pages List</title>
<!-- package css-->
<link href="css/pages-package.css" rel="stylesheet" type="text/css">

<a href="https://icons8.com/icon/79906/preview-pane"></a>
<!-- end header -->
<?php

?>
<div class="clearfix"></div>
</div>
<div class="page-content" id="app">
  <div class="page-pages-list">
    <div class="gutter-wrapper">
      <div class="panel-box">
        <div class="page-content-top">
          <div> <i class="icon icon-pages icon-3x"></i> </div>
          <div>
            <p>Email templates</p>
          </div>
          <div class="private-setting-switch">
            <a href="create_page.php" class="blue-btn">Create New Template</a>
          </div>
        </div>
      </div>
<!-- ITEMS -->
      <div class="panel-box panel-style-ab">
        <div class="panel-box-title">
            <h3>Items</h3>
            <div class="pull-right"><a class="panel-toggle" href="javascript:void(0);"><i class="icon icon-toggle"></i></a></div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-box-content">
            <ul>
                <li v-for="template in itemTemplates">
                    <h5> {{template['title']}}</h5>
                    <p>{{template['description']}}</p>
                    <a class="action-edit-template" :href="'edit_content.php?pageid=' + template.Id"  :id="template.Id">Edit</a>
                </li>
            </ul>
        </div>
    </div>







  <!-- ORDERS -->
      <div class="panel-box panel-style-ab">
        <div class="panel-box-title">
            <h3>Orders</h3>
            <div class="pull-right"><a class="panel-toggle" href="javascript:void(0);"><i class="icon icon-toggle"></i></a></div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-box-content">
            <ul>
                <li v-for="template in orderTemplates">
                    <h5> {{template['title']}}</h5>
                    <p>{{template['description']}}</p>
                    <a class="action-edit-template" :href="'edit_content.php?pageid=' + template.Id"  :id="template.Id">Edit</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- PAYMENTS -->
    <div class="panel-box panel-style-ab">
        <div class="panel-box-title">
            <h3>Payment</h3>
            <div class="pull-right"><a class="panel-toggle" href="javascript:void(0);"><i class="icon icon-toggle"></i></a></div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-box-content">
            <ul>
                <li v-for="template in paymentTemplates">
                    <h5> {{template['title']}}</h5>
                    <p>{{template['description']}}</p>
                    <a class="action-edit-template" :href="'edit_content.php?pageid=' + template.Id"  :id="template.Id">Edit</a>
                </li>
            </ul>
        </div>
    </div>

 <!-- SHIPPING -->
 <div class="panel-box panel-style-ab">
        <div class="panel-box-title">
            <h3>Shipment</h3>
            <div class="pull-right"><a class="panel-toggle" href="javascript:void(0);"><i class="icon icon-toggle"></i></a></div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-box-content">
            <ul>
                <li v-for="template in shippingTemplates">
                    <h5> {{template['title']}}</h5>
                    <p>{{template['description']}}</p>
                    <a class="action-edit-template" :href="'edit_content.php?pageid=' + template.Id"  :id="template.Id">Edit</a>
                </li>
            </ul>
        </div>
    </div>
    
<!-- users -->
<div class="panel-box panel-style-ab">
        <div class="panel-box-title">
            <h3>Buyer / Seller </h3>
            <div class="pull-right"><a class="panel-toggle" href="javascript:void(0);"><i class="icon icon-toggle"></i></a></div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-box-content">
            <ul>
                <li v-for="template in userTemplates">
                    <h5> {{template['title']}}</h5>
                    <p>{{template['description']}}</p>
                    <a class="action-edit-template" :href="'edit_content.php?pageid=' + template.Id"  :id="template.Id">Edit</a>
                </li>
            </ul>
        </div>
    </div>






</div>

</div>

</div>
</div>

</div>
</div>

<div class="clearfix"></div>

<!-- </div> -->

<div class="popup  popup-area popup-delete-confirm" id="DeleteCustomMethod">
  <input type="hidden" class="record_id" value="">
  <div class="wrapper"> <a href="javascript:;" class="close-popup"><img src="images/cross-icon.svg"></a>
    <div class="content-area">
      <p>Are you sure you want to delete this?</p>
    </div>
    <div class="btn-area text-center smaller">
      <input type="button" value="Cancel" class="btn-black-mdx " id="popup_btncancel">
      <input id="popup_btnconfirm" type="button" value="Okay" class="my-btn btn-blue">
      <div class="clearfix"></div>
    </div>
  </div>
</div>


<div class="popup  popup-area" id="SendCustomMethod">
  <input type="hidden" class="record_id" value="">
  <div class="wrapper"> <a href="javascript:;" class="close-popup"><img src="images/cross-icon.svg"></a>
    <div class="form-element">

      <label class="">From:</label>
      <input class="form-control" type="text" name="pg_title" id="from" required maxlength="50" placeholder="hello@arcadier.com" />
      <label class="">To:</label>
      <input class="form-control" type="text" name="pg_title" id="to" required maxlength="50" />
      <label class="">Buyer Name</label>
      <input class="form-control" type="text" name="pg_title" id="buyerName" required maxlength="50" />
      <label class="">Merchant Name</label>
      <input class="form-control" type="text" name="pg_title" id="merchantName" required maxlength="50" />
      <label class="">Invoice ID</label>
      <input class="form-control" type="text" name="pg_title" id="invoiceID" required maxlength="50" />

    </div>
    <div class="btn-area text-center smaller">
      <input type="button" value="Cancel" class="btn-black-mdx " id="popup_btncancel">
      <input id="popup_sendMail" type="button" value="Send Email" class="my-btn btn-blue">
      <div class="clearfix"></div>
    </div>
  </div>
</div>



<div id="cover"></div>

<!-- begin footer -->
<script type="text/javascript">
  jQuery(document).ready(function() {
    $('#no-more-tables1').DataTable({
      // "paging":   false,
      "order": [
        [0, "asc"]
      ],
      "lengthMenu": [
        [20],
        [20]
      ],
      // "ordering": false,
      "info": false,
      "searching": false,
      "pagingType": "first_last_numbers"
    });


    waitForElement('#no-more-tables1_wrapper', function() {
      var pagediv = "<div class ='paging' id = 'pagination-insert'> </div>";
      $('#no-more-tables1_wrapper').append(pagediv);
    });

    waitForElement('#no-more-tables1_length', function() {
      $('#no-more-tables1_length').css({
        display: "none"
      });
    });

    jQuery(".mobi-header .navbar-toggle").click(function(e) {
      e.preventDefault();
      jQuery("body").toggleClass("sidebar-toggled");
    });
    jQuery(".navbar-back").click(function() {
      jQuery(".mobi-header .navbar-toggle").trigger('click');
    });

    /*nice scroll */
    jQuery(".sidebar").niceScroll({
      cursorcolor: "#000",
      cursorwidth: "6px",
      cursorborderradius: "5px",
      cursorborder: "1px solid transparent",
      touchbehavior: true,
      preventmultitouchscrolling: false,
      enablekeyboard: true
    });

    jQuery(".sidebar .section-links li > a").click(function() {
      jQuery(".sidebar .section-links li").removeClass('active');
      jQuery(this).parents('li').addClass('active');
    });


    jQuery('.btn_delete_act').click(function() {
      var page_id = $(this).parents('tr').find('#filename').text();
      console.log(page_id);
      $('.record_id').val(page_id);

      jQuery('#DeleteCustomMethod').show();
      jQuery('#cover').show();
    });

    jQuery('#popup_btnconfirm').click(function() {

      jQuery('#DeleteCustomMethod').hide();
      jQuery('#cover').hide();
    });


    jQuery('#popup_btncancel,.close-popup').click(function() {
      jQuery('#DeleteCustomMethod').hide();
      jQuery('#cover').hide();
    });
  });


  jQuery('.editbutton').click(function() {
    var page_id = $(this).parents('tr').find('#filename').text();
    console.log(page_id);
    $('.record_id').val(page_id);

    jQuery('#SendCustomMethod').show();
    jQuery('#cover').show();
  });

  jQuery('#popup_sendMail').click(function() {

    jQuery('#SendCustomMethod').hide();
    jQuery('#cover').hide();
  });


  jQuery('#popup_btncancel,.close-popup').click(function() {
    jQuery('#SendCustomMethod').hide();
    jQuery('#cover').hide();
  });



  function waitForElement(elementPath, callBack) {
    window.setTimeout(function() {
      if ($(elementPath).length) {
        callBack(elementPath, $(elementPath));
      } else {
        waitForElement(elementPath, callBack);
      }
    }, 10)
  }


  waitForElement('#pagination-insert', function() {
    var pagination = $('#no-more-tables1_paginate');
    $('#pagination-insert').append(pagination);
    // $('#no-more-tables1_paginate').removeClass('dataTables_paginate paging_simple_numbers');
  });
</script>
<!-- <script src="https://unpkg.com/vue/dist/vue.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
<script type="text/javascript" src="scripts/package.js"></script>
<!-- <script type="text/javascript" src="scripts/table.js"></script> -->
<script type="text/javascript" src="scripts/jquery.dataTables.js"></script>
<script>

</script>
<!-- end footer -->