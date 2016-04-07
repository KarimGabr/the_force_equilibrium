<!--content starts-->
		<div id="content">
			<div>
				<img src="images/vader back.jpg"/>
			</div>
			<div>
				<form method="post" action="" id="form2">
					<table style="margin-top:10px;">
						<tr>	
							<h1 class="star1">Sign Up</h1>
						</tr>
						<tr>
							<h2 class="star1">Join me, and together we will rule the Galaxy</h2>
						</tr>
						<tr>
							<td>
								<input type="text" name="u_username" placeholder="Username" maxlength="100" required>
							</td>
							<td>
								<input type="password" name="u_password" placeholder="New password" maxlength="100" required>
							</td>
						</tr>
						<tr>
							<td>
								<input style="margin-top:10px;" type="text" name="u_firstname" placeholder="First name" maxlength="100" required>
							</td>
							<td>
								<input style="margin-top:10px; margin-left:10px;" type="text" name="u_lastname" placeholder="Last name" maxlength="100" required>
							</td>
						</tr>
						<tr>
							<td>
								<input style="margin-top:10px;" type="email" name="u_email" placeholder="Email" maxlength="100" required>
							</td>
							<td>
								<input style="margin-top:10px; margin-left:10px;" type="text" name="u_phonenumber" placeholder="Phone number" maxlength="14">
							</td>
						</tr>
						<tr>
							<td>
								<select style="margin-top:10px;" name="u_gender" required>
									<option>Select Gender</option>
									<option>Male</option>
									<option>Female</option>
								</select>
							</td>
							<td>
								<select style="margin-top:10px; margin-left:10px;" name="u_martialstatus">
									<option>Select martial status </option>
									<option>Single</option>
									<option>Engaged</option>
									<option>Married</option>
								</select>
							</td>
						</tr>
						<tr>	
							<td>
								<select style="margin-top:10px;" name="u_hometown">
									<option>Select Home Town</option>
									<option>Alderaan</option>
									<option>Endor</option>
									<option>Hoth</option>
									<option>Jakku</option>
									<option>Kamino</option>
									<option>Naboo</option>
									<option>Tatooine</option>
								</select>
							</td>
							<td class="star2" align="right">
								Birthday
								<input style="margin-top:10px; margin-left:10px;" type="date" name="u_birthday" required>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input style="margin-top:10px; width:515px;" type="text" name="u_aboutme" placeholder="About you, you should say" maxlength="300">
							</td>
						</tr>
						<tr>
							<td>
								<select style="margin-top:10px;" name="u_forceside" required>
									<option>Select your side</option>
									<option>Light Side</option>
									<option>Dark Side</option>
								</select>
							</td>
							<td colspan="6">
								<button name="sign_up">Sign Up</button>
							</td>
						</tr>
					</table>
				</form>
				<?php 
				include("user_insert.php");
				?>
			</div>
		</div>
		<!--content ends-->