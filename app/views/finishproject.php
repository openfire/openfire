<? global $user; ?>
<div class='span7 well well-small'>
	<legend><span class='muted'><span class='circled'>1</span>Submit Project For Proposal</span><br><b><span class='circled'>2</span></b> Complete Project Details<br><span class='muted'><span class='circled'>3</span> Complete Initial Goal Details</span></legend>

			<form enctype="multipart/form-data" action='' method='post' id='manageProjectForm'>
			<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
						<input type='hidden' name='uuid' value='<?= $this->project->uuid ?>'>
						<fieldset>
							<? if(empty($this->project->wePayAccountID)): ?>
							<legend>Set Up WePay Account To Receive Funds</legend>
							<span class='help-block'>First things first. In order to receive funds through openfire, you need to create a WePay account to actually get the funds.</span>
							<a class='btn btn-info' href='<?= WEPAYAPIURL ?><?= $this->project->uuid ?>&scope=manage_accounts,collect_payments,refund_payments,preapprove_payments,view_balance'>Create WePay Account</a><br><br>
						</fieldset>
						<? else: ?>
						<!-- <b>WePay User ID: <?=$this->project->wePayAccountID ?></b> -->

						</fieldset>
									<span class="help-block">Fields with <b>*</b> are required.</span>

						<fieldset>
							
							<label for='title'><b>*</b> Title</label>
							<input type='text' class='input-xxlarge' name='title'  data-required='true' data-error-message='Your project must have a title.' value="<?= $this->project->title ?>" <? if(!in_array($this->project->status, array("draft","pending approval"))): ?> disabled='disabled' <?endif; ?>><? if(!in_array($this->project->status, array("draft","pending approval"))): ?><?endif;?><span class='help-block'>This is the first thing people see when they see your project, so make it catchy. Once your project has been published, the title cannot be changed.</span>
				 		</fieldset>
						<fieldset>
							<label for='subtitle'><b>*</b> Tagline/Subtitle</label>
							<input type='text' class='input-xxlarge' name='subtitle' value="<?= $this->project->subtitle ?>"  data-required='true' data-error-message='Your project must have a subtitle.'>
									<span class="help-block">This is the <i>second</i> thing people see when they see your project. Make it a short, informative capsule description of what your project is and what it aims to achieve. For example, if your project's title is "Marvin The Paranoid Android", your subtitle would be "Your plastic pal who's fun to be with."</span>

				 		</fieldset>
						<fieldset>
							<label for='mediaEmbed'>Video URL</label>
							<input type='text' class='input-xxlarge' name='mediaEmbed' placeholder='e.g. http://www.youtube.com/watch?v=oHg5SJYRHA0' value="<?= $this->project->mediaEmbed ?>" data-required='true' data-error-message='Your project must have a video.'>

				 		</fieldset>
				 		<br>
				 								<fieldset>
							<label for='summary'><b>*</b> Summary</label>
							 
							<textarea name='summary' id='summary' class='input-xxlarge' style='height: 12em'><?= $this->project->summary ?></textarea>
				 		</fieldset>
						<fieldset>
							<label for='description'><b>*</b> Description</label>
							 
							<textarea name='description' id='description' class='input-xxlarge' style='height: 12em'><? if(!empty($this->project->description)): echo $this->project->description; else: echo $this->project->summary; endif; ?></textarea>
							<span class="help-block">This is the overview of your project that people will see. (We've gone ahead and pasted your initial proposal text in here, to be helpful.) Focus not on any individual goal, but what your project <i>as a whole</i> is supposed to be about.</span>
				 		</fieldset>
<!-- 				 		<fieldset>
				 			<label for='tags'>Tags</label>
				 			<input type='text' name='tags' class='input-xxlarge' placeholder='disruptive, new york, cookies'>
				 			<span class='help-block'>A list of tags for your project, comma-separated.</help>
				 			</fieldset> -->
				 		<fieldset>
				 			<label for='facebook'><i class='icon-facebook'></i> Facebook Page</label>
				 			<input type='text' class='input-xxlarge' name='facebook' placeholder="Your project's Facebook page URL" <? if(!empty($this->project->facebook)): ?>value='<?= $this->project->facebook->url ?>'<?endif;?>>
				 			<label for='twitter'><i class='icon-twitter'></i> Twitter Profile</label>
				 			<input type='text' class='input-xxlarge' name='twitter' placeholder="Your project's Twitter profile's URL" <? if(!empty($this->project->twitter)): ?>value='<?= $this->project->twitter->url ?>'<?endif;?>>
				 			<label for='linkedin'><i class='icon-linkedin'></i> LinkedIn Profile</label>
				 			<input type='text' class='input-xxlarge' name='linkedin' placeholder="Your project's LinkedIn profile's URL">
				 			<label for='homepage'><i class='icon-home'></i> Project Homepage</label>
				 			<input type='text' class='input-xxlarge' name='homepage' placeholder="Your project's homepage URL">
				 		</fieldset>
						<fieldset>
							<label for='icon'>Project Icon</label>
							<div class='row-fluid'><div class='span2'><img src='<?= $this->project->icon ?>' style='width: 128px'></div>
							<div class='span10'><input type='file' name='icon'>
							<span class='help-block'>This is your project's logo or image. Maximum file size 5MB, and we'll resize it to 256x256 pixels. If you don't upload one, you get the default one, which is spiffy, but not as cool as having your own.</span>
						</div>
					</div>
						</fieldset>


<div class="form-actions">
				 			<button type='submit' id='publishButton' class='pull-right btn btn-success' style='margin-left: 1em' name='action' value='publish'>Step 3: Your First Goal</button> <button type='submit' name='action' value='update' class='pull-right btn'>Save As Draft</button> 
				 		</div>
				 							<? endif; ?>
					</form>
	</div>
<div class='span5'>
		<h3>step 2: completing project setup</h3>
		<p>Congratulations! Your project has been approved by openfire. Now you just need to add some more information before you can publish it and start pushing towards victory.</p>

</div>