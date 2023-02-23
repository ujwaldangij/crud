export class general_function{
    static table_heading_maker = (arr) => {
        var html = ``;
        html += `<table class='table table-success table-striped' id='table'>
            <thead>
                <tr class='table-dark'>`;
        $.each(arr, function (indexInArray, valueOfElement) {
            html += `<th scope='col'>${valueOfElement}</th>`;
        });
        html += `</tr>
            </thead>
            </table>`;
        $('.table_maker').html(html);
    }
    static show_table = (response) =>{
        $.ajax({
            type: "post",
            url: "api/show",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('.preloader').show();
            },
            success: function (response) {
                general_function.load_table(response);
            },
            error: function(response) {
                general_function.load_table_errors(response);
            },
            complete: function() {
                $('.preloader').hide();
            },
        });
    }
    static load_table = (response) =>{
        $('#table').DataTable( {
            data: response,
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'email' },
                { data: 'created_at' },
                { data: 'updated_at' },
                {
                    data : 'id',
                    render: function(data,type,row) {
                        return `<button
                          type="button"
                          id="edit"
                          data-edit="${data}"
                          class="btn btn-info"
                          data-bs-toggle="modal"
                          data-bs-target="#edit_record_model">
                          <i class="fa-solid fa-pen-to-square"></i>
                          </button>
                          <button
                          type="button"
                          id="delete"
                          data-delete="${data}"
                          class="btn btn-danger"
                          data-bs-toggle="modal"
                          data-bs-target="#staticBackdrop">
                          <i class="fa-solid fa-trash"></i>
                          </button>
                          `;
                    }
                }
            ],
            responsive: true,
            destroy: true,
        } );
    }
    static load_table_errors = (response) =>{
        if (response.status === 404) {
            $('#table').DataTable();
        }
        if (response.status === 500) {
            return general_function.application_error(response);
        }
    }
    static add_records = (response) =>{
        $(document).on('click','#add', function (e) {
            e.preventDefault();
            var formData1 = new FormData(post_add_form);
            $.ajax({
                type: "post",
                url: "api/add",
                data: formData1,
                contentType: false,
                processData: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('.preloader').show();
                },
                success: function (response) {
                    $('.error').remove();
                    $('#post_add_form')[0].reset();
                    $('#add_record_model').modal('hide');
                    general_function.show_table();
                },
                error: function(response) {
                    if (response.status === 400) {
                        return general_function.add_errors_form(response);
                    }
                    return general_function.application_error(response);
                },
                complete: function() {
                    $('.preloader').hide();
                },
            });
        });
    }
    static add_errors_form = (response) =>{
        $('.error').remove();
        $.each(response.responseJSON, function (indexInArray, valueOfElement) { 
            $(`#${indexInArray}`).after(`<div class='error text-danger fw-bold'>${valueOfElement}</div>`);
        });
    }

    static application_error = (response) =>{
        console.log(response);
        alert("Hi..! Don't panic just call developer he will fix this error because we are getting this type of error -> "+response.responseJSON);
    }
    static fill_edit_records_form = (response) => {
        $(document).on('click','#edit', function (e) {
            $('.error').remove();
            e.preventDefault();
            $('#edit_record_model').modal('show');
            var id = $(this).parent().parent().children();
            var a = [];
            for (let i = 0; i < id.length; i++) {
                a.push(id[i].textContent);
            }
            $('#id_edit').val(a[0]);
            $('#name_edit').val(a[1]);
            $('#email_edit').val(a[2]);
        });
        general_function.submit_edit_records_form();
    }
    static submit_edit_records_form = (response) => {
        $(document).on('click','#edit_submit', function (e) {
            e.preventDefault();
            var formData1 = new FormData(post_edit_form);
            $.ajax({
                type: "post",
                url: "api/edit",
                data: formData1,
                contentType: false,
                processData: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('.preloader').show();
                },
                success: function (response) {
                    $('.error').remove();
                    $('#post_edit_form')[0].reset();
                    $('#edit_record_model').modal('hide');
                    general_function.show_table();
                },
                error: function(response) {
                    if (response.status === 400) {
                        return general_function.add_errors_form(response);
                    }
                    return general_function.application_error(response);
                },
                complete: function() {
                    $('.preloader').hide();
                },
            });
        });
    }
    static delete_record = (response) => {
        $(document).on('click','#delete', function (e) {
            e.preventDefault();
            var data = confirm("Do you realy want to delete because one's delete not be recall");
            var id = $(this).data('delete');
            if (data === true) {
                $.ajax({
                    type: "post",
                    url: "api/delete",
                    data: {"id" : id},
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $('.preloader').show();
                    },
                    success: function (response) {
                        general_function.show_table();
                    },
                    error: function(response) {
                        return general_function.application_error(response);
                    },
                    complete: function() {
                        $('.preloader').hide();
                    },
                });
            }
        });
    }
}