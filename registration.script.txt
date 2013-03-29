$sql = "START TRANSACTION; 
		
		INSERT INTO member(id, firstname, lastname, username, password,
			email, phone, schoolyear, gradsem, gradyear, pledgesem, 
			pledgeyear, Flower_Id, bigbro, littlebro, Status_Id, position,
			birthday, active_sem, risk_management, hide_info)
		VALUES ('$firstname', '$lastname', '$username', '$password',
			'$email', '$phone', $schoolyear, '$gradsem', $gradyear,
			'$pledgesem', $pledgeyear, $Flower_Id, '$bigbro', 
			'$littlebro', $Status_Id, '$position', '$birthday',
			'$active_sem', '$risk_management', '$hide_info');

		SET @id = LAST_INSERT_ID();

		INSERT INTO Address(M_Id, homeaddress, citystatezip, localaddress)
		VALUES (@id, '$homeaddress', '$citystatezip', $localaddress);

";