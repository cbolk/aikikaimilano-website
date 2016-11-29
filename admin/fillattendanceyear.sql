

INSERT INTO attendanceyear (aikidoka_fk)
SELECT id FROM aikidoka WHERE active = 1

UPDATE attendanceyear SET M09 = 0, M10 = 0;

UPDATE attendanceyear ay
LEFT JOIN (SELECT aikidoka_fk, sum(hours) as tot FROM attendance where date > '2016/08/31' AND MOD(MONTH(date)+4,12) = 1 GROUP BY aikidoka_fk, MONTH(date)) AS a ON
	ay.aikidoka_fk = a.aikidoka_fk
SET 
	M09 = tot

UPDATE attendanceyear ay
LEFT JOIN (SELECT aikidoka_fk, sum(hours) as tot FROM attendance where date > '2016/08/31' AND MOD(MONTH(date)+4,12) = 2 GROUP BY aikidoka_fk, MONTH(date)) AS a ON
	ay.aikidoka_fk = a.aikidoka_fk
SET 
	M10 = tot