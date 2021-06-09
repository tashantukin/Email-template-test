(function() {
    var scriptSrc = document.currentScript.src;
    var pathname = (
        window.location.pathname + window.location.search
    ).toLowerCase();
    var packagePath = scriptSrc.replace("/scripts/scripts.js", "").trim();
    console.log(packagePath);
    var re = /([a-f0-9]{8}(?:-[a-f0-9]{4}){3}-[a-f0-9]{12})/i;
    var packageId = re.exec(scriptSrc.toLowerCase())[1];
    const HOST = window.location.host;

    var timezone_offset_minutes = new Date().getTimezoneOffset();
    timezone_offset_minutes =
        timezone_offset_minutes == 0 ? 0 : -timezone_offset_minutes;
    var invoice;
    const url = window.location.href.toLowerCase();
    //get coupon value to display in Admin transaction details page

    const baseURL = window.location.hostname;
    const protocol = window.location.protocol;
    const token = getCookie('webapitoken');

    function getCookie(name){
    var value = '; ' + document.cookie;
    var parts = value.split('; ' + name + '=');
    if (parts.length === 2) {
        return parts.pop().split(';').shift();
    }
    }

    function waitForElement(elementPath, callBack) {
        window.setTimeout(function() {
            if ($(elementPath).length) {
                callBack(elementPath, $(elementPath));
            } else {
                waitForElement(elementPath, callBack);
            }
        }, 500);
    }
    const formatter = new Intl.NumberFormat("en-US", {
        minimumFractionDigits: 2,
    });

    function OptionsShowHide(arr){
        $('.page-content .panel-box:nth-child(3) li').each(function(i){
          if($.inArray( i , arr) > -1){
            $(this).show();
          }else{
            $(this).hide();
          }
        });
    }

    $(document).ready(function() {

        if (url.indexOf("/admin/emailcustomisation") >= 0) {

            //1. Hide the deprecated EDM's on the Orders List
            
            OptionsShowHide([5, 6, 7]); // we only need the last 3 edms from the list, we will hide the rest
            
            //2. Append vue and axios reference on the page
            $('.page-content').attr('id', 'app');

            $('body').append(`<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>`);
            var script = document.createElement('script');
            script.onload = function ()
            {
                new Vue({
                    el: "#app",
                    data()
                    {
                        return {
                            templates: [],
                            orderTemplates: [],
                            paymentTemplates: [],
                            shippingTemplates: [],
                            userTemplates: [],
                            editURL: `${protocol}//${baseURL}/admin/plugins/${packageId}/edit_content.php`
                        }
                    },
        
                    filters: {
                        capitalize: function (str)
                        {
                            return str.charAt(0).toUpperCase() + str.slice(1);
                        },
        
                    },
        
                    methods: {
                        async getAllTemplates(action)
                        {
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
                                vm.userTemplates = vm.templates.Records.filter((template) => template.category === 'Buyer / Seller')
        
                                console.log(vm.templates);
                                console.log(vm.orderTemplates);
                                // return templates
        
                            } catch (error) {
                                console.log("error", error);
                            }
                        },
                    },
                    beforeMount()
                    {
                        this.getAllTemplates('GET')
                    },
        
        
                })


               
                //3. 
            }
            script.src = "https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js";

            document.head.appendChild(script); //or something of the likes

            $('.page-content .panel-box:nth-child(3) ul').prepend(`
            <li v-for="template in orderTemplates">
                <h5> {{template['title']}}</h5>
                <p>{{template['description']}}</p>
                <a class="action-edit-template" :href="editURL + '?pageid=' + template.Id + '&redirect=admin'" :id="template.Id">Edit</a>

               
            </li>`);

            $('.page-content .panel-box:nth-child(3)').after(`
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
                        <a class="action-edit-template" :href="editURL + '?pageid=' + template.Id + '&redirect=admin'" :id="template.Id">Edit</a>
                    </li>
                </ul>
            </div>
        </div>`);
            
            //shipping
            $('.page-content .panel-box:nth-child(4)').after(`
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
                        <a class="action-edit-template" :href="editURL + '?pageid=' + template.Id + '&redirect=admin'" :id="template.Id">Edit</a>
                    </li>
                </ul>
            </div>
        </div>`);
            
        


            
        }


    });
})();