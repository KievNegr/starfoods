<div id="content">
  <table class="table">
    <tr class="tr_header">
      <td class="td">
        <h4><?php echo lang('edit_user_heading');?></h4>
      </td>
    </tr>
    <tr>
      <td>
        <div id="infoMessage"><?php echo $message;?></div>

        <form action="<?php echo base_url('auth/edit_user/'. $user->id);?>" method="post" accept-charset="utf-8">

              <p>
                    <?php echo lang('edit_user_fname_label', 'first_name');?> <br />
                    <?php echo form_input($first_name);?>
              </p>

              <p>
                    <?php echo lang('edit_user_lname_label', 'last_name');?> <br />
                    <?php echo form_input($last_name);?>
              </p>

              <p>
                    <?php echo lang('edit_user_company_label', 'company');?> <br />
                    <?php echo form_input($company);?>
              </p>

              <p>
                    <?php echo lang('edit_user_phone_label', 'phone');?> <br />
                    <?php echo form_input($phone);?>
              </p>

              <p>
                    <?php echo lang('edit_user_password_label', 'password');?> <br />
                    <?php echo form_input($password);?>
              </p>

              <p>
                    <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?><br />
                    <?php echo form_input($password_confirm);?>
              </p>

              <?php if ($this->ion_auth->is_admin()): ?>

                  <h3><?php echo lang('edit_user_groups_heading');?></h3>
                  <?php foreach ($groups as $group):?>
                      <label class="checkbox">
                      <?php
                          $gID=$group['id'];
                          $checked = null;
                          $item = null;
                          foreach($currentGroups as $grp) {
                              if ($gID == $grp->id) {
                                  $checked= ' checked="checked"';
                              break;
                              }
                          }
                      ?>
                      <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
                      <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
                      </label>
                  <?php endforeach?>

              <?php endif ?>

              <?php echo form_hidden('id', $user->id);?>
              <?php echo form_hidden($csrf); ?>

              <p><?php echo form_submit('submit', lang('edit_user_submit_btn'));?></p>

        <?php echo form_close();?>
      </td>
    </tr>
  </table>
</div>