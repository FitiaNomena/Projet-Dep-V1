CREATE OR REPLACE VIEW v_departments_managers AS
SELECT 
    d.dept_no,
    d.dept_name,
    e.first_name AS manager_first_name,
    e.last_name AS manager_last_name
FROM departments d
JOIN dept_manager dm ON d.dept_no = dm.dept_no
JOIN employees e ON dm.emp_no = e.emp_no
WHERE dm.to_date = '9999-01-01';  -- manager actuel

CREATE OR REPLACE VIEW v_employees AS
SELECT *
FROM employees;



CREATE OR REPLACE VIEW v_employees_departements AS
SELECT 
    e.emp_no,
    e.first_name,
    e.last_name,
    d.dept_no,
    d.dept_name
FROM employees e
JOIN dept_emp de ON e.emp_no = de.emp_no
JOIN departments d ON d.dept_no = de.dept_no
WHERE de.to_date = '9999-01-01';


CREATE OR REPLACE VIEW v_nombre_employes_par_departement AS
SELECT 
    dept_no,
    dept_name,
    COUNT(emp_no) AS nb_employes
FROM v_employees_departements
GROUP BY dept_no, dept_name;




CREATE OR REPLACE VIEW v_departements_complets AS
SELECT 
    d.dept_no,
    d.dept_name,
    e.first_name AS manager_first_name,
    e.last_name AS manager_last_name,
    COUNT(de.emp_no) AS nb_employes
FROM departments d
JOIN dept_manager dm ON d.dept_no = dm.dept_no AND dm.to_date = '9999-01-01'
JOIN employees e ON dm.emp_no = e.emp_no
JOIN dept_emp de ON d.dept_no = de.dept_no AND de.to_date = '9999-01-01'
GROUP BY d.dept_no, d.dept_name, e.first_name, e.last_name;

