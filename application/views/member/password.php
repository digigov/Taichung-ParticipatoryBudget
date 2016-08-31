<?php include(__DIR__."/../_admin_header.php"); ?>

<?php function css_section(){ ?>

      <style>
        .slider{
          position:relative;
          text-align: left;
        }
        .control{
          position:absolute;
          text-align: center;
          left:168px;
          top:400px;
        }
      </style>

<?php } ?>

<div  class="container" id="container" style="text-align:center;">
  <div class="now content-list">
  

    <div class="col-md-8">
      <form action="<?=site_url("member/changepwd")?>" method="POST">
        <table class="table table-bordered" style="background:white;">
          <tr>
            <td>請輸入舊密碼</td>
            <td><input type="password" name="oldpwd" /></td>
          </tr>
          <tr>
            <td>請輸入新密碼</td>
            <td><input type="password" name="pwd1" /></td>
          </tr>
          <tr>
            <td>請再確認一次密碼</td>
            <td><input type="password" name="pwd2" /></td>
          </tr>
          <tr>
            <td colspan="2">
              <?php if(isset($error)) { ?>
                <div class="label label-danger"><?=h($error)?></div>            
                <br />
                <br />
              <?php } ?>
              <button class="btn btn-default">登入</button>
            </td>
          </tr>
        </table>
      </form>
    </div>

    <div style='clear:both'></div>
  </div>

</div>

<?php function js_section(){ ?>


<?php } ?>


<?php include(__DIR__."/../_admin_footer.php"); ?>