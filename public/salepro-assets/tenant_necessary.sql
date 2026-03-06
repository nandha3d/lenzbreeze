-- Default tenant setup SQL
INSERT INTO currencies (id, name, code, exchange_rate, is_active, created_at, updated_at)
VALUES (1, 'Indian Rupee', 'INR', 1.0, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE name=name;

INSERT INTO general_settings (id, site_title, currency, staff_access, date_format, theme, currency_position, without_stock, expiry_type, expiry_value, is_packing_slip, `decimal`, site_logo)
VALUES (1, 'SalePro', '1', 'all', 'd-m-Y', 'default', 'prefix', 'no', 'days', '0', 0, 2, 'logo.png')
ON DUPLICATE KEY UPDATE site_title=site_title, currency='1';

INSERT INTO roles (id, name, description, guard_name, is_active, created_at, updated_at)
VALUES (1, 'Admin', 'admin', 'web', 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE name=name;

INSERT INTO users (id, name, email, password, role_id, is_active, created_at, updated_at)
VALUES (1, 'admin', 'admin@admin.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE name=name;

INSERT INTO accounts (id, name, account_no, initial_balance, total_balance, is_default, created_at, updated_at)
VALUES (1, 'Default', '0001', 0, 0, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE name=name;

INSERT INTO warehouses (id, name, phone, email, address, is_active, created_at, updated_at)
VALUES (1, 'Default Warehouse', '', '', '', 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE name=name;

INSERT INTO customer_groups (id, name, percentage, created_at, updated_at)
VALUES (1, 'General', 0, NOW(), NOW())
ON DUPLICATE KEY UPDATE name=name;
