SELECT			{ALIAS}.*, 
				CONCAT({ALIAS}.PersonFirstName, '') AS {ENTITY}LookupCaption, 
				G.GenderName,
				'' AS _Other

FROM			{PREFIX}{NAME} AS {ALIAS}
	LEFT JOIN	sphp_gender AS G ON G.GenderID = {ALIAS}.GenderID
