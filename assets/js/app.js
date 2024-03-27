var table = new DataTable('.myTable', {
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
    },
});

$('#add-form').on('submit', (e) => {
    e.preventDefault();

    var $this = $(e.currentTarget);
    var btn = $this.find('button[type=submit]');
    var spinner = $this.find('.spinner');
    var formData = new FormData(e.currentTarget);

    btn.prop('disabled', true);
    spinner.removeClass('d-none');

    $.ajax({
        url: $this.attr('action'),
        method: $this.attr('method'),
        data: formData,
        contentType: false,
        processData: false,
        success: (response) => {
            response = JSON.parse(response);

            if(response.success){
                mountDataTables(response.model);
                toastr.success(response.message);
                $this.trigger('reset');
                $('#add-modal').modal('hide');
            }else{
                if(response.error && response.message){
                    toastr.error(response.message);
                }else{
                    toastr.error('Erro ao cadastrar.');
                }
            }
        },
        error: (xhr) => {
            toastr.error('Erro na requisição.');
        }
    }).always(() => {
        btn.prop('disabled', false);
        spinner.addClass('d-none');
    })
});

$(document).on('click', 'button[data-edit]', (e) => {
    var $this = $(e.currentTarget);
    var modal = $('#edit-modal');
    var model = $this.data('model');
    var json = $this.data('json');
    clearModalInputs();
    setModalInputsValues(json, model);
    modal.modal('show')
});

$('form[data-edit]').on('submit', (e) => {
    e.preventDefault();

    var $this = $(e.currentTarget);
    var btn = $this.find('button[type=submit]');
    var spinner = $this.find('.spinner');
    var formData = new FormData(e.currentTarget);

    btn.prop('disabled', true);
    spinner.removeClass('d-none');

    $.ajax({
        url: $this.attr('action'),
        method: $this.attr('method'),
        data: formData,
        contentType: false,
        processData: false,
        success: (response) => {
            response = JSON.parse(response);
            if(response.success){
                mountDataTables(response.model);
                toastr.success(response.message);
                $this.trigger('reset');
                $('#edit-modal').modal('hide');
            }else{
                if(response.error && response.message){
                    toastr.error(response.message);
                }else{
                    toastr.error('Erro ao atualizar.');
                }
            }
        },
        error: (xhr) => {
            toastr.error('Erro na requisição.');
        }
    }).always(() => {
        btn.prop('disabled', false);
        spinner.addClass('d-none');
    });
});

$(document).on('submit', 'form[data-delete]', (e) => {
    e.preventDefault();

    var $this = $(e.currentTarget);
    var formData = new FormData(e.currentTarget);

    if(confirm('Deseja excluir este registro? Está ação é irreversível!')){
        $.ajax({
            url: $this.attr('action'),
            method: $this.attr('method'),
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                response = JSON.parse(response);
                if(response.success){
                    mountDataTables(response.model);
                    toastr.success(response.message);
                }
            },
            error: (xhr) => {
                toastr.error('Erro na requisição.');
            }
        });
    }
});

function mountDataTables(model){
    $('.myTable').DataTable().destroy();

    $('.myTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
        },
        ajax: {
            url: `/${model}/ajax`,
            type: 'GET',
            dataSrc: ''
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            { 
                data: model == 'users' ? 'email' : 'name',
                render: function(data){
                    if(model == 'users'){
                        return data;
                    }else{
                        return `<div class="color" style="background-color: ${data}">`;
                    }
                }
            },
            {
                data: null,
                render: function(rowData){
                    return `<button type="button" class="btn btn-primary" data-model="${model}" data-json='${JSON.stringify(rowData)}' data-edit>
                                Editar
                            </button>`;
                }
            },
            {
                data: 'id',
                render: function(data){
                    return `<form action="/${model}/delete/${data}" method="POST" data-delete>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger">
                                    Excluir
                                </button>
                            </form>`;
                }
            }
        ],
    });
};

function clearModalInputs(){
    var modal = $('#edit-modal');
    var form = $('#edit-user');
    
    form.attr('action', '')
    modal.find('#user-id').text('');
    modal.find('#name-edit').val('');
    modal.find('#email-edit').val('');
}

function setModalInputsValues(json, model){
    var modal = $('#edit-modal');
    var form = $('form[data-edit]');
    
    form.attr('action', `${window.location.origin}/${model}/update/${json.id}`)
    modal.find('#model-id').text(`#${json.id}`);
    modal.find('#name-edit').val(json.name);
    modal.find('#email-edit').val(json.email);
}