<?php
/**
 * Created by PhpStorm.
 * User: RKLiang
 * Date: 2016/12/19/0019
 * Time: 20:55
 */

$file = fopen("./liuyan.txt","r");
?>


<table  align="center">
		<tr>
			<th colspan="2">
				留言列表
			</th>
		</tr>
		<tr>
			<td colspan="2">
				<hr width="400" color=#987cb9 SIZE=2>           <!--横线-->
			</td>
		</tr>
		<?php
		$content = '';
			while($arr = fgets($file)){
				if(preg_match('/<昵称:>\s/',$arr)){
					if($content!=''){
		?>
						<tr>
							<th>内容:</th>
							<td>
								<textarea cols="30" rows="10"><?php echo $content;?></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<hr width="400" color=#987cb9 SIZE=1>           <!--横线-->
							</td>
						</tr>
		<?php
					}
					$name = preg_replace('/<昵称:>\s/','',$arr);
		?>
					<tr>
						<th>昵称:</th>
						<td>
							<input type="text" value=$name>
						</td>
					</tr>
		<?php
					}else if(preg_match('/<内容:>\s/',$arr)){
						$content = preg_replace('/<内容:>\s/','',$arr);
					}else{
						$content = $content.$arr;
					}
				}

				fclose($file);
		?>
</table>
