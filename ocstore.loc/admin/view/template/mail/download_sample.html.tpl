<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $title; ?></title>
</head>
<body style="margin:0;padding:0;background:#ddd;">
<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%" style="background:#ddd">
	<tbody>
		<tr>
			<td style="padding:24px 0;">
				<table align="center" cellpadding="0" cellspacing="0" border="0" width="670" style="background:#fff;border:0;border-left:1px solid #ccc;border-right:1px solid #ccc">
					<tbody>
						<tr>
							<td>
								<table cellpadding="0" cellspacing="0" border="0" width="670" style="background:#f2f2f2;table-layout:fixed;">
									<tbody>
										<tr>
											<td height="25" style="border-top:1px solid #ccc;"></td>
										</tr>
										<tr>
											<td valign="middle" style="padding-left:70px;">
												<a href="<?php echo $store_url; ?>" title="<?php echo $store_name; ?>"><img src="<?php echo $logo; ?>" style="border:0;line-height:100%;border:0" alt="<?php echo $store_name; ?>"></a>
											</td>
										</tr>
										<tr>
											<td height="16"></td>
										</tr>
										<tr>
											<td style="background:#fff;border-top:1px solid #ddd;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif">&nbsp;</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td style="background:#fff">
								<table bgcolor="#ffffff" width="670" border="0" cellspacing="0" cellpadding="0">
									<tbody>
										<tr>
											<td style="width:65px">&nbsp;</td>
											<td valign="top">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tbody>
														<tr>
															<td width="10">&nbsp;</td>
															<td style="padding:0px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;color:#333333">
																<h1 style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;color:#333333;font-size:16px;margin-top:0px;margin-bottom:6px"><?php echo $text_heading; ?></h1>
																<p style="margin:0;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;color:#555555;font-size:14px;padding-top:10px;"><?php echo $text_greeting; ?> <strong><?php echo $customer; ?></strong>,</p>
																<p style="margin:0;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;color:#555555;font-size:14px;padding-top:10px;">
																	<?php echo sprintf($text_download_sample, '<a href="' . $download_link . '" style="text-decoration:none;color:#0084b4;">' . $download_name . '</a>'); ?>
																</p>
																<p style="margin:0;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;color:#555555;font-size:14px;padding-top:10px;"><?php echo $text_access_download; ?>
																	<br/>
																	<a href="<?php echo $download_link; ?>" style="text-decoration:none;color:#0084b4;font-size:12px;"><?php echo $download_link; ?></a>
																</p>
																<?php if ($text_download_constraint) { ?><p style="margin:0;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;color:#555555;font-size:14px;padding-top:10px;"><?php echo $text_download_constraint; ?></p><?php } ?>
																<p style="margin:0;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;color:#555555;font-size:14px;padding-top:20px;"><?php echo $text_closing; ?>
																	<br/>
																	<?php echo $sender; ?>
																</p>
															</td>
															<td width="10">&nbsp;</td>
														</tr>
														<tr>
															<td width="10" height="20" colspan="3">&nbsp;</td>
														</tr>
													</tbody>
												</table>
											</td>
											<td style="width:65px">&nbsp;</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td>
							<table bgcolor="#eeeeee" border="0" cellpadding="0" cellspacing="0" width="670" style="background-color:#eee;border-top-color:#ddd;border-top-style:solid;border-top-width:1px">
								<tbody>
									<tr>
										<td colspan="4" height="16"></td>
									</tr>
									<tr>
										<td style="width:85px"></td>
										<td style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:12px;line-height:17px;color:#777;text-align:center;">
												<a href="<?php echo $store_url; ?>" style="border:none;color:#0084b4;text-decoration:none;font-weight:bold;" target="_blank"><?php echo $store_name; ?></a> <?php echo $text_powered_by; ?>
											</td>
											<td style="width:85px"></td>
										</tr>
										<tr>
											<td colspan="3" height="25" style="border-bottom:1px solid #ccc;"></td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>
</body>
</html>
