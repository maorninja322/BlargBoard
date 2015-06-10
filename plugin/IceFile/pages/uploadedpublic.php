<?php
if (!defined('BLARG')) die();
MakeCrumbs(array(actionLink("uploader") => __("Uploader")), $links);
$title = __("Uploaded");
$links = array();?><table class="outline margin">
		<tbody><tr class="header1">
			<th>
				Uploaded
			</th>
		</tr>
		<tr class="cell0">
		<td><iframe style="width:100%;height:400px;background:white;" src="uploads/"></iframe>
		</td>
		</tr>
</tbody></table>
