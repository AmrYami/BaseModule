<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<!--end::Demo Panel-->
<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
{{ Html::script('assets/plugins/global/plugins.bundle.js') }}
{{ Html::script('assets/plugins/custom/prismjs/prismjs.bundle.js') }}
{{ Html::script('assets/js/scripts.bundle.js') }}
<!--end::Global Theme Bundle-->
<!--begin::Page Vendors(used by this page)-->
{{ Html::script('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
{{ Html::script('assets/js/pages/widgets.js') }}
<!--end::Page Scripts-->

<!--begin::Page Vendors(used by this page)-->
{{ Html::script('assets/plugins/custom/datatables/datatables.bundle.js') }}
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
{{ Html::script('assets/js/pages/crud/datatables/basic/paginations.js') }}
<!--end::Page Scripts-->

{{ Html::script('js/main.js') }}


{{-- socket io --}}
<script src="https://code.jquery.com/jquery-migrate-3.2.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.4.0/socket.io.js"></script>

<script type="text/javascript" charset="utf-8" async defer>
    console.log('aaaaaaaaaaaaaaaaaaaaaaaaaaa');
    function appendNotifications(data) {
        console.log(data);
        var html = '<a href="' + data.route + '" class="kt-notification__item"> ' +
            '<div class="kt-notification__item-icon">' +
            '<i class="' + data.icon + '"></i>' +
            ' </div>' +
            '<div class="kt-notification__item-details">' +
            '<div class="kt-notification__item-title">' +
            data.title +
            ' </div>' +
            '<div class="kt-notification__item-time">' +
            data.body +
            '</div>' +
            '</div>' +
            '</a> '
        $("#notification_body").append(html);
        $('#notification-count').html($('#notification-count').html() * 1 + 1);
        console.log(typeof data, data);
        $.ajax({
            method: "GET",
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            url: "{{ route('push') }}",
            data: {data: data}
        }).done(function (response) {
            console.log(data, 'web push', response);
            if (response.status === 'success') {
                console.log(data, 'web push', response);
            }
        }).fail(function (xhr, textStatus, errorThrown) {
            console.log(xhr.responseText, errorThrown, textStatus, 'didnt');
        });
    }

    var socket = io.connect('{{serverName()}}:{{env('PORT_NOTIFICATIONS')}}');
    console.log('message-notifications-{{Auth::id()}}');
    socket.on('message-notifications-{{Auth::id()}}', function (data) {
        data = JSON.parse(data);
        appendNotifications(data);
    });
</script>
