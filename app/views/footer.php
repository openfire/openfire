</div>
<div class='container-fluid'>
  <footer class='navbar'>
    <div class='navbar-inner'>
      <a class='brand'><img src='/img/logo.png' style='height:1em'></a>
      <ul class='nav'>
        <li><a href='#'>Privacy Policy</a></li>
        <li><a href='#'>Team</a></li>
        <li><a href='#'>Blog</a></li>
        <li><a href='#'>Contact Us</a></li>
      </ul>
      <div class='navbar-text clearfix span12' style='font-size:0.8em; text-align:center'>
                <p>We respect your right to privacy. We will not give your name or personal information to third parties. No one will ever see your credit card information besides our payment processor, not even us.</p>
              </div>
      <div class='navbar-text pull-right'>All content &copy; 2013 openfire.</div>
    </div>
  </footer>
  </div>


<div id="getsat-widget-4965"></div>
<script type="text/javascript" src="https://loader.engage.gsfn.us/loader.js"></script>
<script type="text/javascript">
if (typeof GSFN !== "undefined") { GSFN.loadWidget(4965,{"containerId":"getsat-widget-4965"}); }

  $(function() {

    $('.requiresLogin').click(function(e){
    if(typeof($.cookie('user[username]')) == 'undefined'){
      e.preventDefault();
      var link = $(this).attr('href');
      console.log($.cookie('user[lastPage]'));
      $.cookie('user[lastPage]', link,{ path: '/', domain:'openfi.re' });

      $('#loginModal').modal('show');
}
    });
  });

</script>
<div id='loginModal' class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Login</h3>
  </div>
  <div class="modal-body" style='text-align:center'>
          <a class='btn btn-info' href='/auth/facebook' style='background: #596F90; margin-top: 0.5em; margin-bottom: 0.5em'><i class='icon-facebook'></i> Log In With Facebook</a> <a class='btn btn-info' href='/auth/twitter'><i class='icon-twitter'></i> Log In With Twitter</a>
          <hr>
  <form action='/login' method='post'>
    <p>If you already have an openfire account, login below.</p>
      <input type='text' class='input-xlarge' name='login' placeholder='Login'><br>
      <input type='password' class='input-xlarge' name='password' placeholder='Password'><br>
      <button class='btn' type='submit'>Login</button> or <a href='/signup' class='btn btn-info'>Signup</a><br>



 </form>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
  </div>
</div>
</body>
</html>
