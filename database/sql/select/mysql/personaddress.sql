SELECT			{ALIAS}.*, 
				CONCAT({ALIAS}.PersonAddressType, '') AS {ENTITY}LookupCaption, 
				CONCAT(P.PersonFirstName, '', P.PersonLastName) AS PersonName,
				C.CountryName,
				'' AS _Other

FROM			{PREFIX}{NAME} AS {ALIAS}
	LEFT JOIN	{PREFIX}person	 AS P ON P.PersonID = {ALIAS}.PersonID
	LEFT JOIN	sphp_country	 AS C ON C.CountryID = {ALIAS}.CountryID
