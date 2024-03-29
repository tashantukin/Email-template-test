<?php
$page_id = $_GET['pageid'];
$pageContent = file_get_contents(realpath('templates/' . $page_id));

$search = '.html';
$templateName = str_replace($search, '', $page_id);

?>

<title>Template Edit</title>
<!-- begin header -->
<script src="https://cdn.ckeditor.com/4.11.4/full/ckeditor.js"></script>
<!-- package css-->
<link href="css/pages-package.css" rel="stylesheet" type="text/css">
<style>
    .texteditor-container {
        width: 700px;
        height: 365px;
    }

    textarea#editor1 {
        width: 500px !important;
        border: 1px solid red;
    }

    #cke_59_label,
    #cke_60_label,
    #cke_61_label,
    #cke_62_label {
        display: inline !important;
        /*show the text label*/
    }
</style>
<!-- end header -->
<div class="page-content">
    <div class="gutter-wrapper">
        <input type="hidden" id="urlpath" value=<?php echo $userpage; ?>>
        <form>
            <div class="panel-box">
                <div class="page-content-top">
                    <div> <i class="icon icon-pages icon-3x"></i> </div>
                    <div>
                        <span>Add new pages to your marketplace</span>
                    </div>
                    <div class="private-setting-switch">
                        <!-- <a href="#" class="btn-black-mdx" id="showpreviewEdit">Preview</a> -->
                        <span class="grey-btn btn_delete_act">Cancel</span>
                        <a href="#" class="save-btn" id="edit">Save</a>

                        <input type="hidden" id="pageid" value="<?php echo $page_id; ?>">
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
                                        <input class="form-control" type="text" name="pg_title" value="<?php echo $templateName; ?>" id="title" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="">Content</label> <br>
                                    <textarea class="ckeditor" name="editor1" id="editor1"><?php echo $pageContent; ?> </textarea>
                                </div>
                                <div id="display-post" style="width:700px;"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                    </div>

                    <div class="panel-box">


                    </div>

                </div>
                <div class="col-md-4 pgcreate-frm-r">

                </div>
                <div class="clearfix"></div>
            </div>
        </form>
    </div>
</div>
</div>
<div class="clearfix"></div>
<!-- </div> -->

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
    CKEDITOR.replace('editor1', {

        toolbar: [{
                name: 'document',
                groups: ['document', 'doctools'],
                items: ['Preview', 'Source']
            },
            {
                name: 'clipboard',
                groups: ['clipboard', 'undo'],
                items: ['-', 'Undo', 'Redo']
            },
            {
                name: 'editing',
                groups: ['find', 'selection', 'spellchecker'],
                items: ['Find', 'Replace', '-', 'SelectAll', '-']
            },
            {
                name: 'forms',
                items: ['Checkbox', 'Radio']
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
                items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar']
            },
            '/',
            {
                name: 'styles',
                items: ['Styles', 'Format', 'Font', 'FontSize']
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

    CKEDITOR.config.removePlugins = 'elementspath';


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
</script>

<script type="text/javascript">
    jQuery(document).ready(function() {

        // metadesc.onkeyup = metadesc.onpaste = function(e) {
        //     e = e || window.event;
        //     var who = e.target || e.srcElement;
        //     if (who) {
        //         var val = who.value,
        //             L = val.length;
        //         if (L > 300) {
        //             who.style.color = 'red';
        //         } else who.style.color = ''
        //         if (L > 300) {
        //             who.value = who.value.substring(0, 300);
        //             alert('Your message is too long, please shorten it to 300 characters or less');
        //             who.style.color = '';
        //         }
        //     }
        // }

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

        jQuery('.pgcrtseo-aplyllink').click(function() {

        });


        jQuery('.btn_delete_act').click(function() {
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

        //pre fill the meta title with the page title
        $("#title").keyup(function() {
            $("#metatitle").val($('#title').val());

        });

    });
</script>
<script type="text/javascript" src="scripts/package.js"></script>
<!-- end footer -->