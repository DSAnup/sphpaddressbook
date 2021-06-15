SELECT			{ALIAS}.*, 
				CONCAT({ALIAS}.PersonPhoneType, '') AS {ENTITY}LookupCaption, 
				CONCAT(P.PersonFirstName, '', P.PersonLastName) AS PersonName,
				'' AS _Other

FROM			{PREFIX}{NAME} AS {ALIAS}
	LEFT JOIN	{PREFIX}person	 AS P ON P.PersonID = {ALIAS}.PersonID
