
<footer class="main-footer">
    <div class="d-flex align-items-center justify-content-between">
        <strong>
            تم تصميم وتطوير هذا المشروع بواسطة <a href="http://smartvision4p.com/" target="_blank">شركة سمارت فيجن</a> لتقنية المعلومات.
        </strong>
        <strong>
            {{ app(App\Models\GeneralSettings::class)->site_name() }}
            &copy; {{ date('Y') }}
        </strong>
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery script -->
<script src="{{ url('/dashboard') }}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery Ui script -->
<script src="{{ url('/dashboard') }}/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- Bootstrap script -->
<script src="{{ url('/dashboard') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- owl carousel script -->
<script src="{{ url('/dashboard') }}/plugins/owlcarousel/owl.carousel.min.js"></script>

<!-- select2 script -->
<script src="{{ url('/dashboard') }}/plugins/select2/js/select2.js"></script>

<!-- fancybox script -->
<script src="{{ url('/dashboard') }}/plugins/fancybox/js/jquery.fancybox.min.js"></script>

<!-- tagsinput script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

<!-- daterangepicker script -->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>

<!-- dataTables -->
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>

<!-- summernote script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.9.1/summernote-bs5.min.js"></script>

<!-- toastr script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
<!-- sweetalert script -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- adminlte script -->
<script src="{{ url('/dashboard') }}/dist/js/adminlte.js"></script>
<!-- demo script -->
<script src="{{ url('/dashboard') }}/dist/js/demo.js"></script>

<!-- <script src="{{ url('/dashboard') }}/dist/js/pages/dashboard.js"></script> -->
<!-- overlayScrollbars -->
<!-- <script src="{{ url('/dashboard') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> -->

@stack('custom-js')

 <script type="text/javascript">
      $(function () {
        $("#table").DataTable();

        $( "#tablecontents" ).sortable({
          items: "tr",
          cursor: 'move',
          opacity: 0.6,
          update: function() {
              sendOrderToServer();
          }
        });

        function sendOrderToServer() {
          var order = [];
          var model="{{request()->segment(2)}}";
          var token = $('meta[name="csrf-token"]').attr('content');
          $('tr.row1').each(function(index,element) {
            order.push({
              id: $(this).attr('data-id'),
              position: index+1
            });
          });

          $.ajax({
            type: "POST", 
            dataType: "json", 
            url: "{{ route('modelSortable') }}",
                data: {
                    model:model,
                    order: order,
                    _token: token
            },
            success: function(response) {
                if (response.status == "success") {
                  console.log(response);
                } else {
                  console.log(response);
                }
            }
          });
        }
      });


    </script>

<script>
    $(document).ready(function () {
        // Initialize Date Range Picker
        $('#date-range').daterangepicker({
            opens: 'left',
            locale: {
                format: 'YYYY-MM-DD',
                applyLabel: 'تأكيد',
                cancelLabel: 'إلغاء',
                fromLabel: 'من',
                toLabel: 'إلى',
                customRangeLabel: 'تحديد نطاق',
                daysOfWeek: ['أحد', 'اثنين', 'ثلاثاء', 'أربعاء', 'خميس', 'جمعة', 'سبت'],
                monthNames: [
                    'يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو',
                    'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'
                ],
            }
        });
        
    });
</script>
<script>
    $(document).ready(function () {

        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        // Handle pagination link clicks
        $(document).on('click', '.ajax-pagination-link', function (e) {
            e.preventDefault();

            const url = $(this).attr('href'); // Get the URL from the link

            loadTable(url); // Load the table content using AJAX
        });
        $(document).on('change', '#per_page', function (e) {
            e.preventDefault();
            
            const url = $(this).attr('href'); // Get the URL from the link
            
            loadTable(url); // Load the table content using AJAX
        });
        $(document).on('click', '#sortButton', function (e) {
            e.preventDefault();
            
            // Toggle sort direction
            const currentSort = $(this).attr('data-sort');
            const newSort = currentSort === 'asc' ? 'desc' : 'asc';
            $(this).attr('data-sort', newSort); // Update the data-sort attribute
    
            // Update the icon
            const iconClass = newSort === 'asc' ? 'bi-sort-numeric-down' : 'bi-sort-numeric-down-alt';
            $('#sortIcon').attr('class', `bi ${iconClass}`);

            
            const url = $(this).attr('href'); // Get the URL from the link
            loadTable(url); // Load the table content using AJAX
        });
        // Function to load table content
        const loadTable = (url) => {
            const data = {
                per_page: $('#per_page').val(), // Pass per_page if needed
                sortBy: $('#sortButton').attr('data-sort'),     // Pass sortBy if needed
            };
            $.ajax({
                url: url,
                type: "GET",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
                success: function (response) {
                    $('#crud-table-container').html(response.html); // Replace table content
                },
                error: function (error) {
                    console.error("Error loading table:", error);
                }
            });
        };
     
        // 
        $(document).on('change', '.status-checkbox', function () {
            let checkbox = $(this);
            let itemId = checkbox.data('id');
            let url = checkbox.data('url');
            let isChecked = checkbox.is(':checked') ? 'show' : 'hide';
            $.ajax({
                url: url, 
                type: 'POST',
                data: {
                    id: itemId,
                    status: isChecked,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    console.log(response.success)
                    if (response.success === true) {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    alert('An error occurred while updating the status.');
                }
            });
        }); 
        $(document).on('change', '.status-select', function () {
            let select = $(this);
            let itemId = select.data('id');
            let url = select.data('url');
            let selectedStatus = select.val();
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    id: itemId,
                    status: selectedStatus,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.success === true) {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    alert('An error occurred while updating the status.');
                }
            });
        });

        // update Date Time
        function updateDateTime() {
            const now = new Date();
            const locale = @json(App::getLocale() == 'ar' ? 'ar' : 'en-US');
    
            // تحديد الوقت بصيغة الساعة والدقيقة
            const formattedTime = now.toLocaleString(locale, {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
    
            // تحديث الوقت في الصفحة
            $('#current-time').text(formattedTime);
    
            // متابعة إذا كان الوقت 12:00 صباحًا (AM)
            if (now.getHours() === 0 && now.getMinutes() === 0) {
                // تنسيق التاريخ يدويًا: يوم/شهر/سنة
                const day = String(now.getDate()).padStart(2, '0'); // يوم
                const month = String(now.getMonth() + 1).padStart(2, '0'); // شهر (getMonth يبدأ من 0)
                const year = now.getFullYear(); // سنة
    
                // صيغة يوم/شهر/سنة
                const formattedDate = `${day}/${month}/${year}`;
    
                // تحديث التاريخ في الصفحة
                $('#current-date').text(formattedDate);
            }
        }
        setInterval(updateDateTime, 1000);
        updateDateTime();
    });

    $(document).ready(function() {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-center",  // Positioning at the top center
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": 10000,
            "extendedTimeOut": 1000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        toastr.options.timeOut = 10000;
        @if (Session::has('error'))
            toastr.error('{{ Session::get('error') }}');
        @endif
        @if (Session::has('success'))
            toastr.success('{{ Session::get('success') }}');
        @endif
            });

        function changeLanguage(lang) {
            window.location = '{{ url('/change-language') }}/' + lang;
        }

        $(function () {
     
        function readURL(input, previewElement) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    previewElement.css('background-image', 'url(' + e.target.result + ')');
                    previewElement.hide();
                    previewElement.fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    
        $(".imageUpload").change(function() {
        // تحديد عنصر المعاينة المرتبط بعنصر الرفع
        var previewElement = $(this).closest('.avatar-upload').find('.imagePreview');
        readURL(this, previewElement);
    });
    
      // upload images and show it
      function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function(e) {
                  $('.image-upload-wrap').hide();
                  $('.file-upload-content').show();
                  $('.file-title').html(input.files[0].name);
              };
              reader.readAsDataURL(input.files[0]);
          } else {
              removeUpload();
          }
      }
      function removeUpload() {
          $('.file-upload-input').replaceWith($('.file-upload-input').clone());
          $('.file-upload-content').hide();
          $('.image-upload-wrap').show();
      }
      $('.image-upload-wrap').bind('dragover', function () {
          $('.image-upload-wrap').addClass('image-dropping');
      });
      $('.image-upload-wrap').bind('dragleave', function () {
          $('.image-upload-wrap').removeClass('image-dropping');
      });
      
      
      
      
      function check_No() {
    // Get all radio buttons with names containing "inspection_report_id"
    document.querySelectorAll('input[name^="inspection_report_id"]').forEach(function(radio) {
        var id = radio.name.match(/\d+/)[0]; // Extract the ID from the radio name

        var noDescDiv = document.getElementById('No_Desc' + id);
        
        if (radio.checked && radio.value === 'no') {
            noDescDiv.style.display = 'block';
        } else if (radio.checked && radio.value === 'yes') {
            noDescDiv.style.display = 'none';
        }
    });
}

      check_No()
    
      // Add the event listener to call check_No on change events
      document.addEventListener('change', function(event) {
        // Check if the event target is one of the inspection report radios
        if (event.target.matches('input[name^="inspection_report_id"]')) {
            check_No();
        }
      });

      
      
      


        // $(".rateYo").rateYo({
        //     starWidth: "13px",readOnly: true
        // });
 
    });
</script>


<script type="text/javascript">
    $(document).on('click', '.show_confirm', function(event) {
    var form = $(this).closest("form");
    var name = $(this).data("name");

    event.preventDefault();

    swal({
        title: `هل انت متأكد من حذف هذا العنصر؟`,
        text: "إذا قمت بحذف هذا العنصر لن تتمكن من استرجاعه مرة أخرى!",
        icon: "warning",
        buttons: ['لا', 'نعم'],
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            form.submit();
        }
    });
});


    $(document).on('click', '.show_dupconfirm', function(event) {
    var form = $(this).closest("form");
    var name = $(this).data("name");

    event.preventDefault();

    swal({
        title: `هل انت متأكد من تكرار المنتج؟`,
        text: "سيتم نسخ تفاصيل المنتج بأكمله بإضافة (Copy) للاسم",
        icon: "warning",
        buttons: ['لا', 'نعم'],
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            form.submit();
        }
    });
});

$(document).ready(function(){
        $(".card-body").css("opacity", 1);
    });


$(function() {
    $(window).on("load", function() {
        $('.card-body').css('opacity',1);
    });
    $( "form" ).submit(function() {
        $('.btn-success').html('<i class="fa fa-spinner fa-spin"></i>@lang('main.save')');
    });
});
$(document).ready(function () {
$('.send_email_all').on('click', function(e) {


            var allMails = [];  
            $(".sub_chk:checked").each(function() {  
                allMails.push($(this).attr('data-id'));
            });  


            // if(allMails.length <=0)  
            // {  
            //     $('#exampleModalSend').modal('toggle');
            //     alert("Please select row.");  
                
            // }  else {  

            //     $('#exampleModalSend').modal('show');
                    var join_selected_values1 = allMails.join(","); 
                    $('.selected_val').val(join_selected_values1)
            // }  
        });

        $('#master').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $(".sub_chk").prop('checked', true);  
         } else {  
            $(".sub_chk").prop('checked',false);  
         }  
        });
$('.delete_all').on('click', function(e) {
    var allVals = [];  
    $(".sub_chk:checked").each(function() {  
        allVals.push($(this).attr('data-id'));
    });  

    if (allVals.length <= 0) {  
        alert("Please select row.");  
    } else {  
        var check = confirm("Are you sure you want to delete this row?");  
        if (check == true) {  
            $.ajax({
                url: $(this).data('url'),
                type: 'DELETE',
                headers: { 
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json' 
                },
                data: JSON.stringify({ ids: allVals }), 
                success: function (data) {
                    if (data.success) {
                        $(".sub_chk:checked").each(function() {  
                            $(this).parents("tr").remove();
                        });
                        alert(data.success);
                    } else if (data.error) {
                        alert(data.error);
                    } else {
                        alert('Whoops! Something went wrong.');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        }  
    }  
});


        // $('.delete_all').on('click', function(e) {


        //     var allVals = [];  
        //     $(".sub_chk:checked").each(function() {  
        //         allVals.push($(this).attr('data-id'));
        //     });  


        //     if(allVals.length <=0)  
        //     {  
        //         alert("Please select row.");  
        //     }  else {  


        //         var check = confirm("Are you sure you want to delete this row?");  
        //         if(check == true){  


        //             var join_selected_values = allVals.join(","); 


        //             $.ajax({
        //                 url: $(this).data('url'),
        //                 type: 'DELETE',
        //                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //                 data: 'ids='+join_selected_values,
        //                 success: function (data) {
        //                     if (data['success']) {
        //                         $(".sub_chk:checked").each(function() {  
        //                             $(this).parents("tr").remove();
        //                         });
        //                         alert(data['success']);
        //                     } else if (data['error']) {
        //                         alert(data['error']);
        //                     } else {
        //                         alert('Whoops Something went wrong!!');
        //                     }
        //                 },
        //                 error: function (data) {
        //                     alert(data.responseText);
        //                 }
        //             });


        //           $.each(allVals, function( index, value ) {
        //               $('table tr').filter("[data-row-id='" + value + "']").remove();
                      
        //           });
        //         //   $('tbody').html(' <tr><td colspan="4"><h4>@lang('main.no data to show')</h4><td></tr>');
        //         }  
        //     }  
        // });
    });

    // Flag to track if user has interacted
let userHasInteracted = false;

// Button interaction for allowing notifications
{{--document.getElementById('allowNotificationsButton').addEventListener('click', function() {
    userHasInteracted = true;
    console.log("User has clicked the button to allow notifications.");
    alert("You will now receive notifications!");

    // Optionally, start checking for new messages after interaction
    checkForNewMessages();
});--}}
function checkForNewMessages() {

// Poll for new messages
setInterval(function() {
    $.ajax({
        url: '{{url("/admin/check-new-messages")}}',  // Your AJAX endpoint
        method: 'GET',
        success: function(response) {
            if (response.notifications.length > 0  && userHasInteracted) {
                alert("You have a new message!");
                 var audio = new Audio("{{url('notification-sound.mp3')}}");
                    audio.play().catch(error => {
                        console.log("Error playing sound:", error);
                    });
                markNotificationsAsRead();
            }
        }
    });
}, 10000);  // Poll every 5 seconds
}
$(document).ready(function() {
    // Set CSRF token in AJAX header
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  });
function markNotificationsAsRead() {
    $.ajax({
        url: "{{url('/admin/mark-notifications-read')}}",
        method: 'POST',
        success: function() {
            console.log("Notifications marked as read");
        }
    });
}
</script>


</body>

</html>