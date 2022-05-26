<?php
$accounts = file_get_contents('accounts.json') ? json_decode(file_get_contents('accounts.json'), true) : [];
?>
<table class="table" id="accounts">
    <thead class="thead-dark">
        <tr>
            <th class="field">Id</th>
            <th class="field">Login</th>
            <th class="field">Password</th>
            <th class="field">Is Active</th>
            <th class="field">Login Count</th>

            <th>Add New</th>
            <th>Edit</th>
            <th>Change Status</th>
            <th>Remove</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($accounts as $account): ?>
        <tr>
            <td class="field"><?php echo $account['id'];?></td>
            <td class="field"><?php echo $account['login'];?></td>
            <td class="field"><?php echo $account['password'];?></td>
            <td class="field"><?php echo $account['active'] ? 'Yes': 'No';?></td>
            <td class="field"><?php echo count($account['machine']) ?? 0;?></td>

            <td><button type="button" class="btn btn-success" onclick="add();">Add New</button></td>
            <td><button type="button" class="btn btn-primary" onclick="edit(
                '<?php echo $account['id'];?>',
                '<?php echo $account['login'];?>',
                '<?php echo $account['password'];?>',
                '<?php echo $account['active'];?>'
                        );">Edit</button></td>
            <td>
                <button type="button" class="btn btn-info" onclick="toggleStatus(<?php echo $account['id'];?>, <?php echo $account['active'];?>);">
                    <?php echo $account['active'] ? 'Disable': 'Enable';?>
                </button>
            </td>
            <td><button type="button" class="btn btn-danger" onclick="remove(<?php echo $account['id'];?>);">Remove</button></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script>
    function edit(id,login,pass,active){
        if(!$('#add-form').length){
            var row = '';
            var idTemplate = '<td><input type="hidden" name="id" value="'+id+'"/>'+id+'</td>';
            var loginTemplate = '<td><input class="form-control" type="text" name="login" value="'+login+'"/></td>';
            var passwordTemplate = '<td><input class="form-control" type="text" name="password" value="'+pass+'"/></td>';
            var activeTemplate = '<td><select class="custom-select" name="active"><option value="0">No</option><option value="1" >Yes</option></td>';

            var saveTemplate = '<td colspan="2"><button type="button" class="btn btn-success" onclick="editAccount(1);">Save</button></td>';
            var deleteTemplate = '<td colspan="2"><button type="button" class="btn btn-danger" onclick="deleteAccount();">Delete</button></td>';

            row = row + idTemplate + loginTemplate + passwordTemplate + activeTemplate + saveTemplate + deleteTemplate;
            $('#accounts tbody').append('<tr id="add-form">' + row + '</tr>');
            if(active){
                $('.custom-select option[value="1"]').attr('selected', 'seelcted');
            }

        }
    }
    function add(){
        if(!$('#add-form').length){
            var row = '';
            var idTemplate = '<td><?php echo end($accounts)['id'] + 1;?></td>';
            var loginTemplate = '<td><input class="form-control" type="text" name="login"/></td>';
            var passwordTemplate = '<td><input class="form-control" type="text" name="password"/></td>';
            var activeTemplate = '<td><select class="custom-select" name="active"><option value="0">No</option><option value="1">Yes</option></td>';

            var saveTemplate = '<td colspan="2"><button type="button" class="btn btn-success" onclick="editAccount();">Save</button></td>';
            var deleteTemplate = '<td colspan="2"><button type="button" class="btn btn-danger" onclick="deleteAccount();">Delete</button></td>';

            row = row + idTemplate + loginTemplate + passwordTemplate + activeTemplate + saveTemplate + deleteTemplate;
            $('#accounts tbody').append('<tr id="add-form">' + row + '</tr>');
        }
    }
    function editAccount(actionEdit = null){
        if($('[name="login"]').val() && $('[name="password"]').val()){
            $.ajax({
                url: "/api/editAccount.php",
                method: 'POST',
                data: {
                    id: $('[name="id"]').val(),
                    login: $('[name="login"]').val(),
                    password: $('[name="password"]').val(),
                    active: $('[name="active"]').val(),
                    action: actionEdit
                },
                dataType: "json",
                success:function(e){
                    if(e.success === false){
                        alert(e.message);
                    }
                    location.reload();
                }
            });
        }

    }

    function deleteAccount(){
        $('#add-form').remove();
    }
    function toggleStatus(id, currentStatus){
        result = confirm('Are you sure you want to change status of this account?');
        if(result){
            $.ajax({
                url: "/api/toggleStatus.php",
                method: 'POST',
                data: {id:id, currentStatus:currentStatus},
                dataType: "json",
                success:function(e){
                    if(e.success === false){
                        alert(e.message);
                    }
                    location.reload();
                }
            });
        }
    }
    function remove(id){
        result = confirm('Are you sure you want to delete this account?');
        if(result){
            $.ajax({
                url: "/api/delete.php",
                method: 'POST',
                data: {id:id},
                dataType: "json",
                success:function(e){
                    if(e.success === false){
                        alert(e.message);
                    }
                    location.reload();
                }
            });
        }
    }

</script>
<style>
    .field{
        min-width: 200px;
        width: 200px;
    }
</style>