-- Select not registered courses for specific semester for specific student ID
-- SELECT 
--     *
-- FROM
--     Course AS c
-- WHERE
--     CourseCode IN (SELECT 
--             co.CourseCode
--         FROM
--             courseoffer AS co
--         WHERE
--             SemesterCode = '19F')
--         AND CourseCode NOT IN (SELECT 
--             r.CourseCode
--         FROM
--             registration AS r
--         WHERE
-- 			StudentId = 's1');
--             
--             
-- SELECT 
--     course.CourseCode Code, Title, WeeklyHours
-- FROM
--     Course
--         INNER JOIN
--     CourseOffer ON Course.CourseCode = CourseOffer.CourseCode
-- WHERE
--     CourseOffer.SemesterCode = '17W';
--     
-- SELECT 
--     *
-- FROM
--     course
-- WHERE
--     CourseCode IN (SELECT 
--             co.CourseCode
--         FROM
--             courseoffer AS co
--         WHERE
--             SemesterCode = '19F');
--             
--             
-- SELECT * FROM `registration`;




USE cst8257;

DELETE FROM CourseOffer;
DELETE FROM Course;
DELETE FROM Semester;

INSERT INTO Course VALUES ('CST8110', 'Introduction to Computer Programming', 4);
INSERT INTO Course VALUES ('CST8209', 'Web Programming I', 4);
INSERT INTO Course VALUES ('CST8260', 'Database System and Concepts', 3);
INSERT INTO Course VALUES ('ENL1818T', 'Communications I', 3 );
INSERT INTO Course VALUES ('MAT8001', 'Math Fundamentals', 3 );
INSERT INTO Course VALUES ('MGT8100', 'Career and College Success Skills', 3 );
INSERT INTO Course VALUES ('CST8250', 'Database Design and Administration', 4 );
INSERT INTO Course VALUES ('CST8253', 'Web Programming II', 3 );
INSERT INTO Course VALUES ('CST8254', 'Network Operating Systems', 4 );
INSERT INTO Course VALUES ('CST8255', 'Web Imaging and Animations', 3 );
INSERT INTO Course VALUES ('CST8256', 'Web Programming Languages I', 4 );
INSERT INTO Course VALUES ('CST8257', 'Web Applications Development', 4 );
INSERT INTO Course VALUES ('CST8258', 'Web Project Management', 3 );
INSERT INTO Course VALUES ('ENL1819T', 'Reporting Technical Information', 3 );
INSERT INTO Course VALUES ('WKT8100', 'Cooperative Education Work Term Preparation', 5 );
INSERT INTO Course VALUES ('CST8259', 'Web Programming Languages II', 4 );
INSERT INTO Course VALUES ('CST8265', 'Web Security Basics', 4 );
INSERT INTO Course VALUES ('CST8267', 'Ecommerce', 3 );
INSERT INTO Course VALUES ('CON8101', 'Residential Building/Estimating', 5 );
INSERT INTO Course VALUES ('CON8411', 'Construction Materials I', 3 );
INSERT INTO Course VALUES ('CON8430', 'Computers and You', 3 );
INSERT INTO Course VALUES ('MAT8050', 'Geometry and Trigonometry', 3 );
INSERT INTO Course VALUES ('SAF8408', 'Health and Safety', 4 );
INSERT INTO Course VALUES ('SUR8411', 'Construction Surveying I', 5 );
INSERT INTO Course VALUES ('CON8102', 'Commercial Building/Estimating', 5 );
INSERT INTO Course VALUES ('CON8417', 'Construction Materials II', 5 );
INSERT INTO Course VALUES ('ENG8101', 'Statics', 5 );
INSERT INTO Course VALUES ('ENL1818M', 'Communications II', 6 );
INSERT INTO Course VALUES ('MAT8051', 'Algebra', 3 );
INSERT INTO Course VALUES ('SUR8417', 'Construction Surveying II', 3 );
INSERT INTO Course VALUES ('GED0192', 'General Education Elective', 3 );
INSERT INTO Course VALUES ('CAD8400', 'AutoCAD I', 3 );
INSERT INTO Course VALUES ('CON8404', 'Civil Estimating', 3 );
INSERT INTO Course VALUES ('CON8436', 'Building Systems', 5 );
INSERT INTO Course VALUES ('ENG8102', 'Strength of Materials', 3 );
INSERT INTO Course VALUES ('ENG8411', 'Structural Analysis', 3 );
INSERT INTO Course VALUES ('MGT8400', 'Project Administration', 4 );
INSERT INTO Course VALUES ('CAD8405', 'AutoCAD II', 4 );
INSERT INTO Course VALUES ('CON8418', 'Construction Building Code', 3 );
INSERT INTO Course VALUES ('ENG8328', 'Hydraulics', 3 );
INSERT INTO Course VALUES ('ENG8404', 'Introduction to Structural Design', 3 );
INSERT INTO Course VALUES ('ENG8454', 'Geotechnical Materials', 3 );
INSERT INTO Course VALUES ('ENL1819Q', 'Reporting Technical Information II', 5 );
INSERT INTO Course VALUES ('ENV8400', 'Environmental Engineering', 3 );
INSERT INTO Course VALUES ('CON8406', 'Project Scheduling and Cost Control', 3 );
INSERT INTO Course VALUES ('CON8425', ' Design of Steel Structures', 3 );
INSERT INTO Course VALUES ('CON8445', 'Soils Analysis', 3 );
INSERT INTO Course VALUES ('CON8466', 'Highway Engineering', 3 );
INSERT INTO Course VALUES ('ENL4004', 'Orientation to Report Writing', 4);
INSERT INTO Course VALUES ('MAT8201', 'Calculus 1', 3 );
INSERT INTO Course VALUES ('SUR8400', 'Civil Surveying III', 3 );
INSERT INTO Course VALUES ('CON8416', 'GIS for Civil Engineering', 3 );
INSERT INTO Course VALUES ('CON8447', 'Foundations', 3 );
INSERT INTO Course VALUES ('CON8476', 'Business Principles', 3 );
INSERT INTO Course VALUES ('ENG8435', 'Reinforced Concrete Design', 3 );
INSERT INTO Course VALUES ('ENG8451', 'Water and Waste Water Technology', 3 );
INSERT INTO Course VALUES ('ENL8420', 'Project Report', 3 );



INSERT INTO CourseOffer VALUES ('CST8110', '19W');
INSERT INTO CourseOffer VALUES ('CST8209', '19W');
INSERT INTO CourseOffer VALUES ('CST8260', '19W');
INSERT INTO CourseOffer VALUES ('ENL1818T', '19W');
INSERT INTO CourseOffer VALUES ('MAT8001', '19W');
INSERT INTO CourseOffer VALUES ('MGT8100', '19W');
INSERT INTO CourseOffer VALUES ('CST8250', '19W');
INSERT INTO CourseOffer VALUES ('CST8253', '19S');
INSERT INTO CourseOffer VALUES ('CST8254', '19S');
INSERT INTO CourseOffer VALUES ('CST8255', '19S');
INSERT INTO CourseOffer VALUES ('CST8256', '19S');
INSERT INTO CourseOffer VALUES ('CST8257', '19S');
INSERT INTO CourseOffer VALUES ('CST8258', '19F');
INSERT INTO CourseOffer VALUES ('ENL1819T', '19F');
INSERT INTO CourseOffer VALUES ('WKT8100', '19F');
INSERT INTO CourseOffer VALUES ('CST8259', '19F');
INSERT INTO CourseOffer VALUES ('CST8265', '19F');
INSERT INTO CourseOffer VALUES ('CST8267', '19F');
INSERT INTO CourseOffer VALUES ('CON8101', '19F');
INSERT INTO CourseOffer VALUES ('CON8411', '19F');
INSERT INTO CourseOffer VALUES ('CON8430', '19F');
INSERT INTO CourseOffer VALUES ('MAT8050', '17W');
INSERT INTO CourseOffer VALUES ('SAF8408', '17W');
INSERT INTO CourseOffer VALUES ('SUR8411', '17W');
INSERT INTO CourseOffer VALUES ('CON8102', '17W');
INSERT INTO CourseOffer VALUES ('CON8417', '17W');
INSERT INTO CourseOffer VALUES ('ENG8101', '17W');
INSERT INTO CourseOffer VALUES ('ENL1818M', '17W');
INSERT INTO CourseOffer VALUES ('ENL1818T', '17W');
INSERT INTO CourseOffer VALUES ('MAT8001', '17W');
INSERT INTO CourseOffer VALUES ('MGT8100', '17W');
INSERT INTO CourseOffer VALUES ('CST8250', '17W');
INSERT INTO CourseOffer VALUES ('CST8253', '17S');
INSERT INTO CourseOffer VALUES ('CST8254', '17S');
INSERT INTO CourseOffer VALUES ('CST8255', '17S');
INSERT INTO CourseOffer VALUES ('MAT8051', '17S');
INSERT INTO CourseOffer VALUES ('SUR8417', '17S');
INSERT INTO CourseOffer VALUES ('GED0192', '17S');
INSERT INTO CourseOffer VALUES ('CAD8400', '17S');
INSERT INTO CourseOffer VALUES ('CON8404', '17S');
INSERT INTO CourseOffer VALUES ('CON8436', '17S');
INSERT INTO CourseOffer VALUES ('ENG8102', '17S');
INSERT INTO CourseOffer VALUES ('ENG8411', '17F');
INSERT INTO CourseOffer VALUES ('MGT8400', '17F');
INSERT INTO CourseOffer VALUES ('CAD8405', '17F');
INSERT INTO CourseOffer VALUES ('CON8418', '17F');
INSERT INTO CourseOffer VALUES ('ENG8328', '17F');
INSERT INTO CourseOffer VALUES ('ENG8404', '17F');
INSERT INTO CourseOffer VALUES ('ENG8454', '17F');
INSERT INTO CourseOffer VALUES ('ENL1819Q', '18W');
INSERT INTO CourseOffer VALUES ('ENV8400', '18W');
INSERT INTO CourseOffer VALUES ('CON8406', '18W');
INSERT INTO CourseOffer VALUES ('CON8425', '18W');
INSERT INTO CourseOffer VALUES ('CON8445', '18W');
INSERT INTO CourseOffer VALUES ('CON8466', '18W');
INSERT INTO CourseOffer VALUES ('ENG8411', '18W');
INSERT INTO CourseOffer VALUES ('MGT8400', '18W');
INSERT INTO CourseOffer VALUES ('CAD8405', '18W');
INSERT INTO CourseOffer VALUES ('CON8418', '18W');
INSERT INTO CourseOffer VALUES ('ENG8328', '18W');
INSERT INTO CourseOffer VALUES ('ENG8404', '18S');
INSERT INTO CourseOffer VALUES ('ENG8454', '18S');
INSERT INTO CourseOffer VALUES ('ENL4004', '18S');
INSERT INTO CourseOffer VALUES ('MAT8201', '18S');
INSERT INTO CourseOffer VALUES ('SUR8400', '18S');
INSERT INTO CourseOffer VALUES ('CON8416', '18S');
INSERT INTO CourseOffer VALUES ('CON8447', '18F');
INSERT INTO CourseOffer VALUES ('CON8476', '18F');
INSERT INTO CourseOffer VALUES ('ENG8435', '18F');
INSERT INTO CourseOffer VALUES ('ENG8451', '18F');
INSERT INTO CourseOffer VALUES ('ENL8420', '18F');
INSERT INTO CourseOffer VALUES ('CST8110', '18F');
INSERT INTO CourseOffer VALUES ('CST8209', '18F');
INSERT INTO CourseOffer VALUES ('CST8260', '18F');