<? global $user; global $embedly; $partials = new Templater(); ?>
</div>
<div class='splash span12'>

  <div class='tagline span8 offset2'>
    <h1>Things to do, and people to do them.</h1>

    <h4><img src='/img/logo_textual.png' style='height: 1.15em'> is a crowdfunding platform for long-term, socially valuable projects. <a href='/about' style='font-weight:bold'>Learn more.</a></h4>

  </div>

</div>
<div class='row-fluid'>
  <div class='span8'>
<div class='featuredGoals'>
    <h2>Featured Goals</h2>

    <? foreach($this->featuredgoals as $index=>$fgoal): ?>

  <?      $partials->load('partial-goal-mini'); 
      $partials->goal = $fgoal['goal']; 
      $partials->project = new Project($partials->goal->projectID);
      $partials->showProject = true;
      $partials->mediaWidth = 480;
      $partials->publish(); ?>

<?     endforeach;  ?>

</div>
 <h2>New Projects</h2>
  <div class='recentProjects'>
  <? foreach($this->recentprojects as $project): 
  $partials->load('partial-project-mini'); 
      $partials->project = $project;
      $partials->mediaWidth = 320;
      $partials->publish(); 

  endforeach;?>
</div>
</div>
<div class='span3 offset1 sidebar'>
    <div class='item widget projectMenu'>
        <h4>Explore Projects</h4>
        <a href='/projects/'>View All</a><hr>
        <ul class='unstyled'>
        <? foreach($this->categories as $category): if($category->numProjects != 0): ?>
        <li><a href='/projects/categories/<?= $category->slug ?>'><?= $category->name ?> (<?= $category->numProjects ?>)</a></li>
        <? endif; endforeach; ?>
        </ul>
    </div>

    <div class='item widget searchForm'>
      <h4>Search</h4>
      <form class="form-search" action='/search' method='get'>
  <input type="text" name='q' class="input-medium search-query">
  <button type="submit" class="btn">Search</button>
</form>
    </div>

    <div class='item widget'>
    <? if(!empty($user->id)): ?>
    <div class="thumbnail" style='text-align:center'>
      <a href='/users/<?= $user->username ?>'><img src="<?= $user->avatar ?>" class='avatar-large' alt="<?= $user->username ?>">
      <h4><?= $user->username ?></h4></a>
    </div>
    <br>
    <ul class='unstyled'>
    <li><a href='/profile'>My Profile</a></li>
    <li><a href='/profile/#projects'>My Projects</a></li>
    <li><a href='/createProject'>Create A Project</a></li>
    <li><a href='/logout'>Logout</a></li>
  </ul>
  <? else: ?>
  <h4>Help Change The World</h4>
  <p><small>Login or signup today to create a project, join a team, or fund a project you believe in!</small></p>
      <form action='/login' method='post'>
      <input type='text' class='span12' name='login' placeholder='Login'><br>
      <input type='password' class='span12' name='password' placeholder='Password'><br>
      <div class='form-actions' style='text-align:right'>
      <button class='btn' type='submit'>Login</button> <a href='/signup' class='btn btn-info'>Signup</a><br>
      <a class='btn btn-info' href='/auth/facebook' style='background: #596F90; margin-top: 0.5em; margin-bottom: 0.5em'><i class='icon-facebook'></i> Login With Facebook</a><br>
      <a class='btn btn-info' href='/auth/twitter'><i class='icon-twitter'></i> Login With Twitter</a>
    </div>
</form>
<? endif; ?>
    </div>

</div>