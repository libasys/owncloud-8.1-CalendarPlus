<div id="event" class="show-event">
	<input type="hidden" id="eventid" name="eventid" value="<?php p($_['eventid']) ?>">
	<input type="hidden" name="lastmodified" value="<?php p($_['lastmodified']) ?>">
	<input type="hidden" name="choosendate" id="choosendate" value="<?php p($_['choosendate']) ?>">
	<input type="hidden" name="showdate" id="showdate" value="<?php p($_['showdate']) ?>">
	<input type="hidden" name="perm" id="perm" value="<?php p($_['permissions']) ?>">
	<input type="hidden" name="calendar" id="shareCalid" value="<?php p($_['calendar_options'][0]['id']) ?>">
	<input type="hidden" name="sRuleRequest" id="sRuleRequest" value="<?php p($_['repeat_rules']); ?>" />
	<input type="hidden" name="mailNotificationEnabled" id="mailNotificationEnabled" value="<?php p($_['mailNotificationEnabled']) ?>" />
    <input type="hidden" name="allowShareWithLink" id="allowShareWithLink" value="<?php p($_['allowShareWithLink']) ?>" />
	<input type="hidden" name="mailPublicNotificationEnabled"  value="<?php p($_['mailPublicNotificationEnabled']) ?>" />
	<input type="hidden" id="haveshareaction" value="0" />
	<?php
	if(is_array($_['sReminderTrigger'])){
		foreach($_['sReminderTrigger'] as $reminderInfo){
			print_unescaped('<input type="hidden" name="sReminderRequest" class="sReminderRequest" value="'.$reminderInfo.'" />');
		}
	}
	?>
	
	<div style="font-size:16px;color:#0098E4; font-weight:bold;line-height:22px;" class="title" >
		<div style="right:5px;margin-top:0px;float:right;display:block;" class="icons" >
		
		<?php
			if(count($_['categories']) > 0 && $_['categories']!='' ) { 
				if(is_array($_['categories'])){
					$output='';
					foreach($_['categories'] as $categorie) {
						$output.='<span class="catColPrev" style="float:left;margin:2px;position:relative;background-color:'.$categorie['bgcolor'].'; color:'.$categorie['color'].'" title="'.$categorie['name'].'">'.substr(trim($categorie['name']),0,1).'</span>';
					 }
					print_unescaped($output);
				}
			}
		?>
		
		<?php if($_['permissions'] & OCP\PERMISSION_SHARE && $_['isShareApi'] === 'yes') { ?>
			
			<a href="#" class="share action permanent icon-share" 
				data-item-type="<?php p($_['sharetypeevent']) ?>" 
				data-item="<?php p($_['sharetypeeventprefix'].$_['eventid']) ?>" 
				data-link="true"
				data-title="<?php p($_['title']) ?>"
				data-possible-permissions="<?php p( $_['permissions']) ?>"
				title="<?php p($l->t('Share Event')) ?>"
				>
			</a>
			
		<?php } ?>
		
		<?php
			print_unescaped('<span class="colCal" title="'.$_['aCalendar']['displayname'].'" style="float:left;margin-left:8px;padding:5px;margin-top:2px;position:relative;background-color:'.$_['aCalendar']['calendarcolor'].';">&nbsp;</span>');
		?>
		
		</div>
		<?php p(isset($_['title']) ? $_['title'] : '') ?>
	</div>
	
	<?php if($_['location']!=''){ ?>
	<div class="location" >
		<a id="showLocation" style="font-size:14px; color:#818181;" target="_blank" href="http://maps.google.com/maps?q=<?php p(isset($_['location']) ? $_['location'] : '') ?>&amp;z=20" data-geo="data-geo"><?php p(isset($_['location']) ? $_['location'] : '') ?></a>
	</div>
	<?php } ?>	
	
	<div class="datetime" style="font-size:14px;line-height:28px;">
		<i class="ioc ioc-calendar"></i> <?php p($_['datetimedescr']);?>
	</div>
	
	<table>
	<?php if($_['sReminderTrigger']!=''){ ?>
			<tr>
				<th class="leftDescr" style="vertical-align: top;"><i class="ioc ioc-clock" title="<?php p($l->t("Reminder"));?>"></i></th>
				<td>
					<?php p($_["cValarm"]);?>
					<div id="reminderoutput" style="margin-top:0px;">&nbsp;</div>
				</td> 
			</tr>
	<?php } ?>
	
	<?php if($_['repeat']!=='doesnotrepeat'){?>
			<tr>
				<th class="leftDescr" style="vertical-align: top;"><i class="ioc ioc-repeat" title="<?php p($l->t("Repeating"));?>"></i></th>
				<td>
					<div id="rruleoutput" style="margin-top:0px;display:inline;">&nbsp;</div>
					<span style="font-size:12px; color:#6D7D94;">(<?php p($l->t("End"));?>: <?php p($_['repeatInfo']['end']);?>)</span>
				</td>
			</tr>
		
		<?php if($_['exDate']!=''){ ?>
			<table>
				<tr>
					<th class="leftDescr" style="vertical-align: top;"><i style="color:#A81700;" class="ioc ioc-info-1"></i> <?php p($l->t("Exception"));?></th>
					<td>
						<ul class="exdatelist">
						<?php foreach($_['exDate'] as $key => $value) { ?>
							<li class="exdatelistrow" data-exdate="<?php p($key); ?>"><?php p($value); ?><?php if($_['permissions'] & OCP\PERMISSION_DELETE) { ?> <i class="ioc ioc-delete" style="cursor:pointer"></i><?php } ?></li>
						<?php } ?>
						</ul>
					</td>
				</tr>
			</table>
		<?php } ?>
		
	<?php } ?>
	
	<?php if($_['description']!=''){ ?>
		<tr>
			<th class="leftDescr" style="vertical-align: top;"><i style="margin-top:-3px;" class="ioc ioc-notice" title="<?php p($l->t("Notice"));?>"></i></th>
			<td style="white-space:normal;">
				<div class="showevent-descr">
					<?php p(isset($_['description']) ? $_['description'] : '') ?>
				</div>
			</td>	
		</tr>
	<?php } ?>
		
	<?php if($_['link']!=''){ ?>
		<tr>
			<th class="leftDescr"><i class="ioc ioc-location" title="<?php p($l->t("URL"));?>"></i></th>
			<td style="white-space:normal;text-align:left;">
				<a  target="_blank" href="<?php p($_['link']) ?>"  title="<?php p($_['link']) ?>"><?php p($l->t("Link"));?></a>
			</td>
		</tr>
	<?php } ?>
	</table>
	
	<div id="actions" style="float:left;width:100%;padding-top:5px;">
		<div class="button-group" style="width:46.5%; float:left;">
		<?php 
			$DeleteButtonTitle=$l->t("Delete");
			if($_['addSingleDeleteButton'] ) {
				$DeleteButtonTitle=$l->t("Serie");
			}
		 ?> 

		<?php if($_['permissions'] & OCP\PERMISSION_DELETE) { ?>
			 <button class="button" id="showEvent-delete"  data-link="<?php print_unescaped(\OC::$server->getURLGenerator()->linkToRoute($_['appname'].'.event.deleteEvent')) ?>"><?php p($DeleteButtonTitle);?> <i class="ioc ioc-block text-danger"></i></button> 
				<?php if($_['addSingleDeleteButton'] ) { ?>
					<button class="button" id="editEvent-delete-single" data-link="<?php print_unescaped(\OC::$server->getURLGenerator()->linkToRoute($_['appname'].'.event.deleteSingleRepeatingEvent')) ?>"><?php p($l->t("Event"));?> <i class="ioc ioc-block text-danger"></i></button> 

				<?php } ?>
			<?php } ?> 
		<?php if($_['bShareOnlyEvent'] && $_['permissions'] & OCP\PERMISSION_SHARE) { ?>	 
				<button class="button" id="editEvent-add"  name="addSharedEvent" data-link="<?php print_unescaped(\OC::$server->getURLGenerator()->linkToRoute($_['appname'].'.event.addSharedEvent')) ?>"><?php p($l->t("Add"));?></button>
		
		<?php } ?> 
		</div>	
	
		<div class="button-group" style="float:right;">
			<button id="closeDialog" class="button"><?php p($l->t("Cancel"));?></button> 
				
			<?php if($_['permissions'] & OCP\PERMISSION_UPDATE) { ?>
				<button id="editEventButton" style="min-width:60px;" class="button"><?php p($l->t("Edit"));?></button> 		
			<?php } ?>
			
		</div>
	</div>
</div>