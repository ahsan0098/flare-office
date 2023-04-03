$(document).ready(function () {
    window.livewire.emit('loader');
    var readURL = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.changeprofile').attr('src', e.target.result);
                $('.changepro').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
        // alert('test');
    }


    $("#image_select").on('change', function () {
        readURL(this);
    });

    $("#upload_image").on('click', function () {
        $("#image_select").click();
    });
});

$(document).on('keyup', "#search_btn", function (e) {
    var txt = $(this).val();
    window.livewire.emit('search');
});
$(document).on('change', ".rdo", function (e) {
    var valu = $(this).val();
    var rdo = $(this).attr('data-id');
    var id = $(this).attr('data-att');
    window.livewire.emit('radio_attendance', rdo, valu, id);
});
window.addEventListener('swal:message', function (e) {
    swal.fire(e.detail).then(function (f) {
        $("#dept_form")[0].reset();
        // $("#sub_dept_form")[0].reset();
        // $("#add_emp")[0].reset();
        // $("#edit_emp")[0].reset();
        // $('#edit_employe').modal("hide");
        // chatbox.classList.toggle("active");
    });
});
window.addEventListener('swal:add_employes', function (e) {
    swal.fire(e.detail).then(function (f) {
        $('#add_employe').modal("hide");
        $("#add_emp")[0].reset();
    });
});
window.addEventListener('swal:edit_employes', function (e) {
    swal.fire(e.detail).then(function (f) {
        $('#edit_employe').modal("hide");

    });
});
window.addEventListener('attendance', function (e) {
    // swal.fire([
    //     'icon' => 'success',
    //     'text' => 'Your attendance has been marked',
    // ]);
    Swal.fire(
        'Thank you!',
        'Your attendance has been maked!',
        'success'
    )
    $('#attendace_modal').modal("hide");
    $('#att_btn').toggleClass("fade");
});
window.addEventListener('btn-show', function (e) {
    // alert('alert done');
    $('#att_btn').removeClass('fade');
});
window.addEventListener('btn-fade', function (e) {
    // alert('alert done');
    $('#att_btn').addClass('fade');
});
window.addEventListener('swal:confirmDelete', function (e) {
    swal.fire(e.detail).then((result) => {
        if (result.isConfirmed) {
            window.livewire.emit('deleteEmp', e.detail.id);
        }
    }).catch(err => {
        console.log(err);
    });
});

//         $(document).ready(function(){

//         //     $(document).on('click', '.upload_image', function(e) {
//         //     e.preventDefault();
//         //     $('#image_select').click();
//         //     // alert("");
//         // });
//         function readURL(input) {
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();
//         reader.onload = function (e) {
//             // $(".changeprofile").attr("src", e.target.result);
//             // $(".changeprofile").hide();
//             // $(".changeprofile").fadeIn(100);
//             $(input)
//                 .parent()
//                 .parent()
//                 .find(".changeprofile")
//                 .attr("src", e.target.result)
//                 .hide()
//                 .fadeIn(1);
//         };
//         reader.readAsDataURL(input.files[0]);
//     }

// }
// $(".image_select").change(function () {
//     readURL(this);
// });
//         });
// $(document).on('change', "#image_select", function(f) {
//     // $("[name=upload_form]").trigger('submit');
//     // $('#upload_form').submit();
//     window.livewire.emit('upload_image');
// });
// $(document).on('submit', '#upload_form', function(e) {
//     e.preventDefault();
//     // alert('fdf');
//     // var image = $("#image_select").files[0];
//     // window.livewire.emit('upload_image');
//     // $('#image_select').click();
// });
window.addEventListener('swal:updateProfile', function (e) {
    swal.fire(e.detail).then(function (f) {

        $('#edit_profile_modal').modal('toggle');

    });
});
window.addEventListener('swal:updatepassword', function (e) {
    swal.fire(e.detail);
    // $("#exampleModal").classList.toggle("fade");
});
window.addEventListener('swal:not_permission', function (e) {
    // $(e.detail.btn).attr('disabled', 'disabled');
    swal.fire([

    ]);
});
var toastMixin = Swal.mixin({
    toast: true,
    icon: 'success',
    title: 'General Title',
    animation: false,
    position: 'top-right',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
window.addEventListener('swal:toast', function (e) {
    // alert('sfsdfs');
    toastMixin.fire({
        title: e.detail.title,
        icon: e.detail.icon,
    });
});

window.addEventListener('not_permission', function (e) {
    if (e.detail.message == 0) {
        toastMixin.fire({
            title: e.detail.title,
            icon: e.detail.icon
        });
    }
    if (e.detail.message == 1) {
        $(e.detail.prop_id).modal('toggle');
    }
    // alert(e.detail.message);
});
