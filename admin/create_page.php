<title>Template Create</title>

<!-- begin header -->
<script src="https://cdn.ckeditor.com/4.11.4/full/ckeditor.js"></script>
<!-- package css-->
<link href="css/pages-package.css" rel="stylesheet" type="text/css">

<style type="text/css">
  #cke_50_label,
  #cke_51_label,
  #cke_52_label,
  #cke_53_label {
    display: inline !important;
    /*show the text label*/
  }
</style>


<!-- end header -->
<div class="page-content">
  <div class="gutter-wrapper">
    <form>
      <div class="panel-box">
        <div class="page-content-top">
          <div> <i class="icon icon-pages icon-3x"></i> </div>
          <div>
            <span>Add new Email Template to your marketplace</span>
          </div>
          <div class="private-setting-switch">
            <span class="grey-btn btn_delete_act">Cancel</span>
            <a href="#" class="save-btn" id="save">Save</a>
          </div>
        </div>
      </div>

      <div class="row pgcreate-frmsec">
        <div class="col-md-8 pgcreate-frm-l ">
          <div class="panel-box">
            <div class="pgcreate-frmarea form-area">
              <div class="row">
                <div class="col-md-7">
                  <div class="form-group ">
                    <label class="">Template Title</label>
                    <input class="form-control" type="text" name="pg_title" id="title" required maxlength="65" />
                  </div>
                </div>

                <div class="col-md-12" style="display:none">
                  <div class="form-group ">
                    <label class="">Web URL</label>
                    <div class="pgcrtseo-weburlsec">
                      <span id="marketplaceURL"></span>
                      <input type="text" name="meta_weburl" id="metaurl" />
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <label class="">Content</label> <br>
                  <textarea class="ckeditor" name="editor1" id="editor1"></textarea required>
                        </div>  
                        <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
                <div class="panel-box">

                   
      </div>

  </div>
 

</div>
<div class="clearfix"></div>
</div>
</form>
</div>
</div>
</div>
<div class="clearfix"></div>

<div class="popup  popup-area popup-delete-confirm " id="DeleteCustomMethod">
  <div class="wrapper"> <span class="close-popup"><img src="images/cross-icon.svg"></span>
    <div class="content-area">
      <p>Are you sure you want to cancel this?</p>
    </div>
    <div class="btn-area text-center smaller">
      <input type="button" value="Cancel" class="btn-black-mdx " id="popup_btncancel">
      <input id="popup_btnconfirm_cancel" type="button" value="Okay" class="my-btn btn-blue">
      <div class="clearfix"></div>
    </div>
  </div>
</div>

<div id="cover"></div>

<!-- begin footer -->

<script>
  var editor = CKEDITOR.replace('editor1', {
    // , items: [ 'Preview','Source']                            
    toolbar: [{
        name: 'document',
        groups: ['document', 'doctools']
      },
      {
        name: 'clipboard',
        groups: ['clipboard', 'undo'],
        items: ['-', 'Undo', 'Redo']
      },
      {
        name: 'editing',
        groups: ['find', 'selection', 'spellchecker'],
        items: ['-', 'SelectAll', '-']
      },
      '/',
      {
        name: 'basicstyles',
        groups: ['basicstyles', 'cleanup'],
        items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-']
      },
      {
        name: 'paragraph',
        groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-']
      },
      {
        name: 'links',
        items: ['Link', 'Unlink']
      },
      {
        name: 'insert',
        items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'imageuploader']
      },
      '/',
      {
        name: 'styles',
        items: ['Format', 'Font', 'FontSize']
      },
      {
        name: 'colors',
        items: ['TextColor', 'BGColor', 'youtube']
      },
      '/',
      {
        items: ['BuyerName', 'MerchantName', 'InvoiceID', 'TotalAmount']
      }

    ],
    extraPlugins: 'BuyerName, MerchantName, InvoiceID,TotalAmount'
  });
  
  

  //insert another toolbar for ckeditor

  //buyer name
  CKEDITOR.plugins.add('BuyerName', {
    init: function(editor) {
      var pluginName = 'BuyerName';
      editor.ui.addButton('BuyerName', {
        label: 'Buyer Name',
        command: 'OpenWindow1'
        // icon: 'images/cross-icon.svg'
      });
      var cmd = editor.addCommand('OpenWindow1', {
        exec: showMyDialog1
      });
    }
  });


  //merchant name
  CKEDITOR.plugins.add('MerchantName', {
    init: function(editor) {
      var pluginName = 'MerchantName';
      editor.ui.addButton('MerchantName', {
        label: 'Merchant Name',
        command: 'OpenWindow2'
        // icon: 'images/cross-icon.svg'
      });
      var cmd = editor.addCommand('OpenWindow2', {
        exec: showMyDialog2
      });
    }
  });

  //Invoice id
  CKEDITOR.plugins.add('InvoiceID', {
    init: function(editor) {
      var pluginName = 'InvoiceID';
      editor.ui.addButton('InvoiceID', {
        label: 'Invoice ID',
        command: 'OpenWindow3'
        // icon: 'images/cross-icon.svg'
      });
      var cmd = editor.addCommand('OpenWindow3', {
        exec: showMyDialog3
      });
    }
  });

  //total Amount
  CKEDITOR.plugins.add('TotalAmount', {
    init: function(editor) {
      var pluginName = 'TotalAmount';
      editor.ui.addButton('TotalAmount', {
        label: 'Total Amount',
        command: 'OpenWindow4'
        // icon: 'images/cross-icon.svg'
      });
      var cmd = editor.addCommand('OpenWindow4', {
        exec: showMyDialog4
      });
    }
  });



  function showMyDialog1(e) {
    e.insertHtml('<h4 style="color:blue"> {{ Buyer Name }} </h4>');
  }

  function showMyDialog2(e) {
    e.insertHtml('<h4 style="color:blue"> {{ Merchant Name }} </h4>');
  }

  function showMyDialog3(e) {
    e.insertHtml('<h4 style="color:blue"> {{ Invoice ID }} </h4>');
  }

  function showMyDialog4(e) {
    e.insertHtml('<h4 style="color:blue"> {{ Total Amount }} </h4>');
  }


  CKEDITOR.config.allowedContent = true;


  data2 = CKEDITOR.instances.editor1.getData();
  html = CKEDITOR.instances.editor1.getSnapshot();
  dom = document.createElement("DIV");
  dom.innerHTML = html;
  plain_text = (dom.textContent || dom.innerText);
  var res1 = plain_text.charAt(plain_text.length - 1);

  meta = $('#metadescs1');
  meta.text(plain_text);


  function GetContents1() {


    data2 = CKEDITOR.instances.editor1.getData();
    html = CKEDITOR.instances.editor1.getSnapshot();
    dom = document.createElement("DIV");
    dom.innerHTML = html;
    plain_text = (dom.textContent || dom.innerText);

    meta = $('#metadescs1');
    meta.text(plain_text);

  }


  CKEDITOR.config.removePlugins = 'elementspath';


  //TEST FUNCTION
  function getCharFromPos(editor) {
    var sWord = '';
    var endPos = setCursorPos(editor);
    var sText = editor.document.$.body.innerText;

    while (endPos > 0) {
      var ch = sText.charAt(endPos);
      if (ch == ' ')
        break;

      sWord += ch;
      endPos--;
    }

    return sText.substring(endPos, 1 + cursorPos.z);
  }

  function setCursorPos(editor) {
    if (!editor)
      return;

    var objRange = editor.document.$.selection.createRange();
    var sOldRange = objRange.text;
    var sTempStr = '%$#'

    //insert the sTempStr where the cursor is at
    objRange.text = sOldRange + sTempStr;
    objRange.moveStart('character', (0 - sOldRange.length - sTempStr.length));

    //save off the new string with sTempStr 
    var sNewText = editor.document.$.body.innerText;
    console.log('editor ' + sNewText);
    //set the actual text value back to how it was
    objRange.text = sOldRange;

    // locate sTempStr  and get its position
    for (var i = 0; i <= sNewText.length; i++) {
      var sTemp = sNewText.substring(i, i + sTempStr.length);
      if (sTemp == sTempStr) {
        var curPos = (i - sOldRange.length);
        return curPos - 1;
      }
    }
    return 0;
  }
</script>

<script type="text/javascript">
  jQuery(document).ready(function() {

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


    jQuery('.pgcrt-link-cstmseo').click(function() {
      jQuery('.pgcrt-meta-seosec').addClass('hide');
      jQuery('.pgcrt-meta-seoeditsec').removeClass('hide');
    });


    jQuery('.pgcrtseo-canclelink').click(function() {
      jQuery('.pgcrt-meta-seosec').removeClass('hide');
      jQuery('.pgcrt-meta-seoeditsec').addClass('hide');
    });

    jQuery('.btn_delete_act').click(function() {
      jQuery('#DeleteCustomMethod').show();
      jQuery('#cover').show();
    });

    jQuery('#popup_btnconfirm').click(function() {
      jQuery('#DeleteCustomMethod').hide();
      jQuery('#cover').hide();
    });

    jQuery('#popup_btnconfirm_cancel').click(function() {
      // jQuery('#DeleteCustomMethod').hide();
      // jQuery('#cover').hide();
    });

    jQuery('#popup_btncancel,.close-popup').click(function() {
      jQuery('#DeleteCustomMethod').hide();
      jQuery('#cover').hide();
    });

    //pre fill the meta title with the page title and replace the spaces with (-)
    $("#title").keyup(function() {
      title = $('#title').val();
      $("#metatitle").val($('#title').val());

      str = title.replace(/\s+/g, '-').toLowerCase();
      $("#metaurl").val(str);

    });

    function maxLength(el) {
      if (!('maxLength' in el)) {
        var max = el.attributes.maxLength.value;
        el.onkeypress = function() {
          if (this.value.length >= max) {
            ;
            return false;
          } //

        };
      }
    }


  });
</script>
<script type="text/javascript" src="scripts/package.js"></script>
<!-- end footer -->