-- Histone Solutions Website Database Schema
-- Module 2.1: Database Architecture
-- Created: 2025-10-02

-- Drop tables if they exist (for fresh installation)
DROP TABLE IF EXISTS post_tags;
DROP TABLE IF EXISTS blog_tags;
DROP TABLE IF EXISTS blog_comments;
DROP TABLE IF EXISTS blog_posts;
DROP TABLE IF EXISTS blog_categories;
DROP TABLE IF EXISTS email_campaign_logs;
DROP TABLE IF EXISTS email_campaigns;
DROP TABLE IF EXISTS email_subscribers;
DROP TABLE IF EXISTS quote_items;
DROP TABLE IF EXISTS quotes;
DROP TABLE IF EXISTS contacts;
DROP TABLE IF EXISTS projects_portfolio;
DROP TABLE IF EXISTS seo_redirects;
DROP TABLE IF EXISTS seo_metadata;
DROP TABLE IF EXISTS site_settings;
DROP TABLE IF EXISTS users;

-- ======================
-- USERS & AUTHENTICATION
-- ======================

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'editor', 'author') DEFAULT 'author',
    avatar VARCHAR(255),
    bio TEXT,
    status ENUM('active', 'inactive') DEFAULT 'active',
    last_login DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_role (role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ======================
-- BLOG SYSTEM
-- ======================

CREATE TABLE blog_categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    description TEXT,
    parent_id INT NULL,
    meta_title VARCHAR(60),
    meta_description VARCHAR(160),
    image VARCHAR(255),
    display_order INT DEFAULT 0,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (parent_id) REFERENCES blog_categories(id) ON DELETE SET NULL,
    INDEX idx_slug (slug),
    INDEX idx_parent (parent_id),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE blog_posts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    meta_title VARCHAR(60),
    meta_description VARCHAR(160),
    excerpt TEXT,
    content LONGTEXT NOT NULL,
    featured_image VARCHAR(255),
    author_id INT NOT NULL,
    category_id INT,
    status ENUM('draft', 'published', 'scheduled') DEFAULT 'draft',
    visibility ENUM('public', 'private', 'password') DEFAULT 'public',
    password VARCHAR(255),
    published_at DATETIME,
    scheduled_at DATETIME,
    views INT DEFAULT 0,
    reading_time INT COMMENT 'in minutes',
    featured BOOLEAN DEFAULT FALSE,
    allow_comments BOOLEAN DEFAULT TRUE,
    seo_keywords JSON COMMENT 'Array of keywords',
    schema_markup JSON COMMENT 'Structured data',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES blog_categories(id) ON DELETE SET NULL,
    INDEX idx_slug (slug),
    INDEX idx_status (status),
    INDEX idx_published (published_at, status),
    INDEX idx_category (category_id),
    INDEX idx_featured (featured),
    INDEX idx_author (author_id),
    FULLTEXT INDEX idx_search (title, content, excerpt)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE blog_tags (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    slug VARCHAR(50) UNIQUE NOT NULL,
    description VARCHAR(255),
    usage_count INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_slug (slug)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE post_tags (
    post_id INT NOT NULL,
    tag_id INT NOT NULL,
    PRIMARY KEY (post_id, tag_id),
    FOREIGN KEY (post_id) REFERENCES blog_posts(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES blog_tags(id) ON DELETE CASCADE,
    INDEX idx_post (post_id),
    INDEX idx_tag (tag_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE blog_comments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    post_id INT NOT NULL,
    parent_id INT NULL COMMENT 'For threaded comments',
    author_name VARCHAR(100) NOT NULL,
    author_email VARCHAR(100) NOT NULL,
    author_website VARCHAR(255),
    author_ip VARCHAR(45),
    content TEXT NOT NULL,
    status ENUM('pending', 'approved', 'spam', 'trash') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES blog_posts(id) ON DELETE CASCADE,
    FOREIGN KEY (parent_id) REFERENCES blog_comments(id) ON DELETE CASCADE,
    INDEX idx_post (post_id),
    INDEX idx_status (status),
    INDEX idx_parent (parent_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ======================
-- CONTACT & LEADS
-- ======================

CREATE TABLE contacts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    company VARCHAR(100),
    project_type ENUM('amazon_integration', 'saas_development', 'api_development', 'ai_integration', 'consultation', 'other') DEFAULT 'other',
    budget_range ENUM('under_5k', '5k_10k', '10k_25k', '25k_50k', '50k_plus', 'not_sure') DEFAULT 'not_sure',
    timeline ENUM('urgent', 'within_month', 'within_3months', 'flexible') DEFAULT 'flexible',
    message TEXT NOT NULL,
    source VARCHAR(50) COMMENT 'Where did they find us',
    ip_address VARCHAR(45),
    user_agent TEXT,
    status ENUM('new', 'contacted', 'qualified', 'converted', 'closed', 'spam') DEFAULT 'new',
    assigned_to INT,
    priority ENUM('low', 'medium', 'high', 'urgent') DEFAULT 'medium',
    notes TEXT,
    subscribed_newsletter BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (assigned_to) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_email (email),
    INDEX idx_status (status),
    INDEX idx_created (created_at),
    INDEX idx_priority (priority)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ======================
-- QUOTATION SYSTEM
-- ======================

CREATE TABLE quotes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    quote_number VARCHAR(20) UNIQUE NOT NULL,
    contact_id INT,
    client_name VARCHAR(100) NOT NULL,
    client_email VARCHAR(100) NOT NULL,
    client_company VARCHAR(100),
    project_title VARCHAR(255) NOT NULL,
    project_description TEXT,
    subtotal DECIMAL(10, 2) DEFAULT 0,
    tax_rate DECIMAL(5, 2) DEFAULT 0,
    tax_amount DECIMAL(10, 2) DEFAULT 0,
    discount_percent DECIMAL(5, 2) DEFAULT 0,
    discount_amount DECIMAL(10, 2) DEFAULT 0,
    total_amount DECIMAL(10, 2) NOT NULL,
    currency VARCHAR(3) DEFAULT 'USD',
    payment_terms TEXT,
    validity_days INT DEFAULT 30,
    valid_until DATE,
    terms_conditions TEXT,
    notes TEXT,
    status ENUM('draft', 'sent', 'viewed', 'accepted', 'rejected', 'expired') DEFAULT 'draft',
    sent_at DATETIME,
    viewed_at DATETIME,
    accepted_at DATETIME,
    rejected_at DATETIME,
    rejection_reason TEXT,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (contact_id) REFERENCES contacts(id) ON DELETE SET NULL,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_quote_number (quote_number),
    INDEX idx_status (status),
    INDEX idx_contact (contact_id),
    INDEX idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE quote_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    quote_id INT NOT NULL,
    item_type ENUM('service', 'product', 'hourly', 'fixed') DEFAULT 'service',
    title VARCHAR(255) NOT NULL,
    description TEXT,
    quantity DECIMAL(10, 2) DEFAULT 1,
    unit_price DECIMAL(10, 2) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    display_order INT DEFAULT 0,
    FOREIGN KEY (quote_id) REFERENCES quotes(id) ON DELETE CASCADE,
    INDEX idx_quote (quote_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ======================
-- PORTFOLIO/PROJECTS
-- ======================

CREATE TABLE projects_portfolio (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    tagline VARCHAR(255),
    description TEXT,
    detailed_description LONGTEXT,
    client_name VARCHAR(100),
    client_company VARCHAR(100),
    project_type ENUM('saas', 'amazon_integration', 'api_development', 'web_app', 'mobile_app', 'ai_ml', 'other') DEFAULT 'other',
    technologies JSON COMMENT 'Array of technologies used',
    challenges TEXT,
    solutions TEXT,
    results TEXT,
    metrics JSON COMMENT 'Key metrics and achievements',
    featured_image VARCHAR(255),
    gallery_images JSON COMMENT 'Array of image URLs',
    project_url VARCHAR(255),
    github_url VARCHAR(255),
    start_date DATE,
    end_date DATE,
    duration_months INT,
    team_size INT,
    budget_range VARCHAR(50),
    featured BOOLEAN DEFAULT FALSE,
    showcase BOOLEAN DEFAULT FALSE COMMENT 'Show on homepage',
    status ENUM('completed', 'ongoing', 'archived') DEFAULT 'completed',
    display_order INT DEFAULT 0,
    views INT DEFAULT 0,
    testimonial TEXT,
    testimonial_author VARCHAR(100),
    testimonial_title VARCHAR(100),
    meta_title VARCHAR(60),
    meta_description VARCHAR(160),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_slug (slug),
    INDEX idx_featured (featured),
    INDEX idx_showcase (showcase),
    INDEX idx_project_type (project_type)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ======================
-- EMAIL MARKETING
-- ======================

CREATE TABLE email_subscribers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) UNIQUE NOT NULL,
    name VARCHAR(100),
    status ENUM('pending', 'subscribed', 'unsubscribed', 'bounced') DEFAULT 'pending',
    subscription_source VARCHAR(50) COMMENT 'contact_form, newsletter, footer, etc',
    preferences JSON COMMENT 'Email preferences',
    verification_token VARCHAR(64),
    verified_at DATETIME,
    subscribed_at TIMESTAMP,
    unsubscribed_at DATETIME,
    unsubscribe_reason TEXT,
    ip_address VARCHAR(45),
    user_agent TEXT,
    tags JSON COMMENT 'Subscriber tags/segments',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_status (status),
    INDEX idx_subscribed (subscribed_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE email_campaigns (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    preview_text VARCHAR(255),
    from_name VARCHAR(100),
    from_email VARCHAR(100),
    reply_to VARCHAR(100),
    html_content LONGTEXT,
    text_content TEXT,
    template_id INT,
    segment_filter JSON COMMENT 'Criteria for recipient selection',
    status ENUM('draft', 'scheduled', 'sending', 'sent', 'paused', 'cancelled') DEFAULT 'draft',
    scheduled_at DATETIME,
    sent_at DATETIME,
    recipients_count INT DEFAULT 0,
    sent_count INT DEFAULT 0,
    delivered_count INT DEFAULT 0,
    opened_count INT DEFAULT 0,
    clicked_count INT DEFAULT 0,
    bounced_count INT DEFAULT 0,
    unsubscribed_count INT DEFAULT 0,
    open_rate DECIMAL(5, 2),
    click_rate DECIMAL(5, 2),
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_status (status),
    INDEX idx_scheduled (scheduled_at),
    INDEX idx_sent (sent_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE email_campaign_logs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    campaign_id INT NOT NULL,
    subscriber_id INT NOT NULL,
    event_type ENUM('sent', 'delivered', 'opened', 'clicked', 'bounced', 'complained', 'unsubscribed') NOT NULL,
    link_url VARCHAR(255) COMMENT 'For click events',
    ip_address VARCHAR(45),
    user_agent TEXT,
    event_data JSON COMMENT 'Additional event data',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (campaign_id) REFERENCES email_campaigns(id) ON DELETE CASCADE,
    FOREIGN KEY (subscriber_id) REFERENCES email_subscribers(id) ON DELETE CASCADE,
    INDEX idx_campaign (campaign_id),
    INDEX idx_subscriber (subscriber_id),
    INDEX idx_event (event_type),
    INDEX idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ======================
-- SEO MANAGEMENT
-- ======================

CREATE TABLE seo_metadata (
    id INT PRIMARY KEY AUTO_INCREMENT,
    page_type VARCHAR(50) NOT NULL COMMENT 'service, project, blog, custom, etc',
    page_id INT COMMENT 'ID of the related record',
    page_url VARCHAR(255) UNIQUE NOT NULL,
    meta_title VARCHAR(60),
    meta_description VARCHAR(160),
    meta_keywords VARCHAR(255),
    og_title VARCHAR(60),
    og_description VARCHAR(160),
    og_image VARCHAR(255),
    og_type VARCHAR(20) DEFAULT 'website',
    twitter_card VARCHAR(20) DEFAULT 'summary_large_image',
    twitter_title VARCHAR(60),
    twitter_description VARCHAR(160),
    twitter_image VARCHAR(255),
    canonical_url VARCHAR(255),
    robots VARCHAR(50) DEFAULT 'index, follow',
    schema_markup JSON COMMENT 'JSON-LD structured data',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_page (page_type, page_id),
    INDEX idx_url (page_url)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE seo_redirects (
    id INT PRIMARY KEY AUTO_INCREMENT,
    old_url VARCHAR(255) NOT NULL,
    new_url VARCHAR(255) NOT NULL,
    redirect_type INT DEFAULT 301 COMMENT '301, 302, 307, etc',
    active BOOLEAN DEFAULT TRUE,
    hit_count INT DEFAULT 0,
    last_accessed DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_old_url (old_url),
    INDEX idx_active (active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ======================
-- SITE SETTINGS
-- ======================

CREATE TABLE site_settings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value LONGTEXT,
    setting_type ENUM('string', 'text', 'number', 'boolean', 'json') DEFAULT 'string',
    category VARCHAR(50) DEFAULT 'general',
    description VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_key (setting_key),
    INDEX idx_category (category)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ======================
-- INITIAL DATA
-- ======================

-- Insert default admin user (password: admin123 - CHANGE THIS!)
INSERT INTO users (name, email, password, role, status) VALUES
('Muhammad Awais Naseem', 'awaisnaseem1@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'active');

-- Insert default blog categories
INSERT INTO blog_categories (name, slug, description, meta_title, meta_description) VALUES
('Amazon SP-API', 'amazon-sp-api', 'Tutorials and guides for Amazon Seller Central API development', 'Amazon SP-API Tutorials', 'Learn Amazon SP-API development with practical guides and examples'),
('SaaS Development', 'saas-development', 'Building scalable SaaS applications', 'SaaS Development Guides', 'Expert guides on building and scaling SaaS applications'),
('AI & Machine Learning', 'ai-machine-learning', 'AI integration, LLMs, and machine learning tutorials', 'AI & ML Tutorials', 'Learn AI integration with OpenAI, Claude, and LangChain'),
('Web Development', 'web-development', 'Modern web development tutorials and best practices', 'Web Development Tutorials', 'Full-stack web development guides and best practices'),
('Case Studies', 'case-studies', 'Real-world project case studies and success stories', 'Project Case Studies', 'Learn from real-world development projects and success stories');

-- Insert default site settings
INSERT INTO site_settings (setting_key, setting_value, setting_type, category, description) VALUES
('site_name', 'Histone Solutions', 'string', 'general', 'Website name'),
('site_tagline', 'Building Excellence in Every Line of Code', 'string', 'general', 'Website tagline'),
('company_name', 'Histone Solutions Private Limited', 'string', 'general', 'Full company name'),
('contact_email', 'info@histone.com.pk', 'string', 'contact', 'Primary contact email'),
('contact_phone', '+92 51 8359491', 'string', 'contact', 'Contact phone number'),
('contact_address', 'First Floor, House 5A, Commercial Block-A Satellite Town, Rawalpindi, Punjab 46000', 'text', 'contact', 'Physical address'),
('blog_posts_per_page', '10', 'number', 'blog', 'Number of posts per page'),
('enable_comments', 'true', 'boolean', 'blog', 'Enable blog comments'),
('google_analytics_id', '', 'string', 'seo', 'Google Analytics tracking ID'),
('smtp_host', '', 'string', 'email', 'SMTP server host'),
('smtp_port', '587', 'number', 'email', 'SMTP server port'),
('smtp_username', '', 'string', 'email', 'SMTP username'),
('smtp_password', '', 'string', 'email', 'SMTP password'),
('smtp_from_name', 'Histone Solutions', 'string', 'email', 'Email from name'),
('smtp_from_email', 'noreply@histone.com.pk', 'string', 'email', 'Email from address');

-- =========================================
-- VIEWS FOR COMMON QUERIES (Performance)
-- =========================================

-- Published blog posts with category
CREATE VIEW view_published_posts AS
SELECT
    bp.id,
    bp.title,
    bp.slug,
    bp.excerpt,
    bp.featured_image,
    bp.published_at,
    bp.views,
    bp.reading_time,
    bp.featured,
    bc.name AS category_name,
    bc.slug AS category_slug,
    u.name AS author_name
FROM blog_posts bp
LEFT JOIN blog_categories bc ON bp.category_id = bc.id
LEFT JOIN users u ON bp.author_id = u.id
WHERE bp.status = 'published' AND bp.published_at <= NOW()
ORDER BY bp.published_at DESC;

-- ============
-- INDEXES SUMMARY
-- ============
-- All tables have proper indexes for:
-- 1. Primary keys
-- 2. Foreign keys
-- 3. Status columns
-- 4. Date/time columns used in queries
-- 5. Search columns (email, slug, etc.)
-- 6. Full-text search on blog content
