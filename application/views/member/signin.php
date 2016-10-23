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

<div  class="container" id="container">
  <div class="now content-list">

    <div class="col-md-8">
      <form action="<?=site_url("member/signing")?>" method="POST">
        <table class="table table-bordered" style="background:white;">
          <tr>
            <td style="text-align:center;">帳號</td>
            <td><input  type="text" name="acc" /></td>
          </tr>
          <tr>
            <td style="text-align:center;">密碼</td>
            <td><input type="password" name="pwd" /></td>
          </tr>
          <tr>
            <td colspan="2">
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