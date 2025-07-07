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
