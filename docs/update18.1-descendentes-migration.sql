INSERT INTO descendants (descentant_id,root_id) 
	SELECT id,publications_id FROM publications WHERE publications_id is not null;