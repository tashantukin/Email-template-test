(function ()
{
    var scriptSrc = document.currentScript.src;
    var urlss = window.location.href.toLowerCase();
    var packagePath = scriptSrc.replace('/scripts/package.js', '').trim();
    var indexPath = scriptSrc.replace('/scripts/package.js', '/index.php').trim();
    var pagelist = scriptSrc.replace('/scripts/package.js', '/pages_list.php').trim();
    var token = commonModule.getCookie('webapitoken');
    var re = /([a-f0-9]{8}(?:-[a-f0-9]{4}){3}-[a-f0-9]{12})/i;
    var packageId = re.exec(scriptSrc.toLowerCase())[1];
    var marketplace = scriptSrc.replace('/admin/plugins/' + packageId + '/scripts/package.js', '/pages/').trim();
    var userId = $('#userGuid').val();
    var data1;
    var timezone_offset_minutes = new Date().getTimezoneOffset();
    timezone_offset_minutes = timezone_offset_minutes == 0 ? 0 : -timezone_offset_minutes;
    var pagedids;

    const baseURL = window.location.hostname;
    const protocol = window.location.protocol;

    //run on creation page only
    new Vue({
        el: "#app",
        data()
        {
            return {
                templates: [],
                orderTemplates: [],
                paymentTemplates: [],
                shippingTemplates: [],
                userTemplates: []
            }
        },

        filters: {
            capitalize: function (str)
            {
                return str.charAt(0).toUpperCase() + str.slice(1);
            },

        },

        methods: {
            async getAllTemplates(action){
                try {
                    vm = this;
                    const response = await axios({
                    method: action,
                    url: `${protocol}//${baseURL}/api/v2/plugins/${packageId}/custom-tables/Templates`,
                   // data: data,
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                    })
                    const templates = await response
                    vm.templates = templates.data

                    vm.orderTemplates = vm.templates.Records.filter((template) => template.category === 'Orders')
                    vm.paymentTemplates = vm.templates.Records.filter((template) => template.category === 'Payment')
                    vm.shippingTemplates = vm.templates.Records.filter((template) => template.category === 'Shipment')
                    vm.userTemplates =  vm.templates.Records.filter((template) => template.category === 'Users')

                    console.log(vm.templates);
                    console.log(vm.orderTemplates);
                    // return templates
                
                } catch (error) {
                    console.log("error", error);
                }
            },
        },
        beforeMount(){
            this.getAllTemplates('GET')
         },


    })

    function savePageContent()
    {
        $('#save').addClass('disabled');

        data1 = CKEDITOR.instances.editor1.getData();
        console.log(data1);
        var data = { 'userId': userId, 'title': $('#title').val(), 'content': data1,'subject': $('#subject').val(), 'description' : $('#description').val(), 'type' : $("#email-type option:selected").text()  };
        var apiUrl = packagePath + '/save_new_content.php';
        $.ajax({
            url: apiUrl,
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function (result)
            {
                console.log(JSON.stringify(result));
                toastr.success('New email template successfully saved.');
                $('#title').val('');
                $('#save').removeClass('disabled');
                window.location.href = indexPath;
            },
            error: function (jqXHR, status, err)
            {
            }
        });
    }

    function saveModifiedPageContent()
    {
        data1 = CKEDITOR.instances.editor1.getData();
        var data = { 'pageId': $('#pageid').val(), 'userId': userId, 'title': $('#title').val(), 'content': data1 , 'subject': $('#subject').val(), 'description' : $('#description').val(), 'template-id' : $('#pageid').val(), 'type' : $("#email-type option:selected").text() };
        var apiUrl = packagePath + '/save_modified_content.php';
        $.ajax({
            url: apiUrl,
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function (result)
            {
                console.log(JSON.stringify(result));
                toastr.success('Page Contents successfully updated.');
                $('#title').val('');
                 window.location.href = indexPath;
            },
            error: function (jqXHR, status, err)
            {
            }
        });
    }

    function deletePage()
    {
        var data = { 'pageId': pagedids, 'userId': userId };
        console.log(pagedids);
        var apiUrl = packagePath + '/delete_content.php';
        $.ajax({
            url: apiUrl,
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function (result)
            {
                console.log(JSON.stringify(result));
                toastr.success('Page Content successfully deleted.');
                location.reload();
            },
            error: function (jqXHR, status, err)
            {
            }
        });
    }

    function sendMail()
    {
        var data = { 'template': $('.record_id').val(), 'userId': userId, 'to': $('#to').val(), 'from': $('#from').val(), 'buyerName': $('#buyerName').val(), 'merchantName': $('#merchantName').val(), 'invoice': $('#invoiceID').val() };
        var apiUrl = packagePath + '/send_edm.php';
        $.ajax({
            url: apiUrl,
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function (result)
            {
                console.log(JSON.stringify(result));
                toastr.success('Sample Email has been sent. Please check your email.');
                location.reload();
            },
            error: function (jqXHR, status, err)
            {
            }
        });
    }

    $(document).ready(function ()
    {

        $('.paging').css('margin', 'auto');

        // var pathname = (window.location.pathname + window.location.search).toLowerCase();

        // const index1 = '/admin/plugins/' + packageId;
        // const index2 = '/admin/plugins/' + packageId + '/';
        // const index3 = '/admin/plugins/' + packageId + '/index.php';
        // if (pathname == index1 || pathname == index2 || pathname == index3) {
        //     window.location = pagelist + '?tz=' + timezone_offset_minutes;
        // }

        //save the page contents
        $('#save').click(function ()
        {

            //add field validations
            savePageContent();
            // }
        });
        //save modified page contents
        $('#edit').click(function ()
        {

            if ($("#title").val() == "" || data1 == "") {
                console.log('true');
                toastr.error('Please fill in empty fields.');

            }
            else {
                saveModifiedPageContent();
            }
        });

        //delete the page contents
        $('#popup_btnconfirm').click(function ()
        {

            pagedids = $('.record_id').val();
            deletePage();
            //
        });

        $('#popup_sendMail').click(function ()
        {
            sendMail();

        });


        //cancel button
        $('#popup_btnconfirm_cancel').click(function ()
        {
            window.location.href = indexPath;
        });

    });
})();