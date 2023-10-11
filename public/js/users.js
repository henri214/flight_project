$(function() {
    var route = $("#routeToUsers").data('route');
    var table = $('#myUserTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: route,
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'username',
                name: 'username'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'role',
                name: 'role'
            },
            {
                data: 'phone',
                name: 'phone'
            },
            {
                data: 'page_id',
                name: 'page_id'
            },
            {
                data: 'age',
                name: 'age'
            },
            {
                data: 'gender',
                name: 'gender'
            },
            {
                data: 'deleted_at',
                name: 'deleted_at'
            },
            {
                data: 'action',
                name: 'action'
            },
        ],
        initComplete: function() {
            $('.edit-button').on('click', function() {
                let modal = $('#editModal');
                modal.find('#username').val($(this).data('username'))
                modal.find('#email').val($(this).data('email'))
                modal.find('#age').val($(this).data('age'))
                modal.find('#media').val($(this).data('media'))
                modal.find('#phone').val($(this).data('phone'))
                modal.find('#page_id').val($(this).data('page_id'))
                modal.find('#gender').val($(this).data('gender'))
                modal.find('#edit-form').attr('action', $(this).data('attr'));
            })
        }
    });
});