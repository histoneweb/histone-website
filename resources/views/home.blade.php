@extends('layouts.app')

@section('meta')
    <!-- Primary Meta Tags -->
    <title>Histone Solutions - Enterprise Full Stack Development & Amazon SP-API Integration Services</title>
    <meta name="title" content="Histone Solutions - Full Stack Development & Amazon SP-API Integration">
    <meta name="description" content="Enterprise-grade full-stack development company with 14+ years of expertise. Specialized in Amazon SP-API integration, AI/ML solutions (OpenAI GPT-4, Claude, LangChain), SaaS development, and scalable web applications for businesses worldwide.">
    <meta name="keywords" content="Full Stack Development Company, Amazon SP-API Integration Services, SaaS Development Agency, Enterprise Web Development, PHP Laravel Development, Python Development, AI Integration Services, OpenAI GPT-4, Claude API, LangChain, Machine Learning Solutions, Amazon Integration, Web Development Pakistan, Rawalpindi IT Company, AI Chatbot Development">
    <meta name="author" content="Histone Solutions Private Limited">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://histone.com.pk/">
    <meta property="og:title" content="Histone Solutions - Enterprise Full Stack Development & Amazon SP-API Integration">
    <meta property="og:description" content="Enterprise-grade development company with 14+ years of expertise in Amazon SP-API integration, AI/ML solutions, and SaaS development for businesses worldwide.">
    <meta property="og:image" content="https://histone.com.pk/assets/images/og-image.jpg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://histone.com.pk/">
    <meta property="twitter:title" content="Histone Solutions - Enterprise Full Stack Development & Amazon SP-API Integration">
    <meta property="twitter:description" content="Enterprise-grade development company with 14+ years of expertise in Amazon SP-API integration, AI/ML solutions, and SaaS development for businesses worldwide.">
    <meta property="twitter:image" content="https://histone.com.pk/assets/images/og-image.jpg">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/icons/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/icons/apple-touch-icon.png') }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="https://histone.com.pk/">

    <!-- Preconnect for performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">

    <!-- Schema.org Structured Data -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@graph": [
            {
                "@@type": "Organization",
                "@@id": "https://histone.com.pk/#organization",
                "name": "Histone Solutions Private Limited",
                "alternateName": "Histone Solutions",
                "url": "https://histone.com.pk",
                "logo": "https://histone.com.pk/assets/images/logos/logo-black.png",
                "description": "Enterprise-grade full-stack development company specializing in Amazon SP-API integration, AI/ML solutions, and SaaS product development with 14+ years of expertise serving businesses worldwide.",
                "address": {
                    "@@type": "PostalAddress",
                    "streetAddress": "First Floor, House 5A, Commercial Block-A, Satellite Town",
                    "addressLocality": "Rawalpindi",
                    "addressRegion": "Punjab",
                    "postalCode": "46000",
                    "addressCountry": "Pakistan"
                },
                "contactPoint": {
                    "@@type": "ContactPoint",
                    "telephone": "+92-51-8359491",
                    "email": "info@histone.com.pk",
                    "contactType": "customer service",
                    "areaServed": ["US", "UK", "EU", "Australia", "Pakistan"],
                    "availableLanguage": ["English", "Urdu"]
                },
                "foundingDate": "2011",
                "numberOfEmployees": "1-10",
                "areaServed": ["US", "UK", "EU", "Australia", "Pakistan"],
                "sameAs": [
                    "https://www.linkedin.com/in/muhammadawaisnaseem/",
                    "https://github.com/histonedev"
                ],
                "serviceArea": {
                    "@@type": "GeoCircle",
                    "geoMidpoint": {
                        "@@type": "GeoCoordinates",
                        "latitude": "33.6007",
                        "longitude": "73.0679"
                    }
                }
            },
            {
                "@@type": "Service",
                "serviceType": "Amazon SP-API Integration",
                "provider": {
                    "@@id": "https://histone.com.pk/#organization"
                },
                "description": "Complete Amazon Seller Partner API integration, MWS to SP-API migration, seller tools development, and marketplace integration solutions.",
                "areaServed": ["US", "UK", "EU", "Australia", "Global"],
                "offers": {
                    "@@type": "Offer",
                    "priceRange": "$$$",
                    "priceCurrency": "USD",
                    "availability": "https://schema.org/InStock"
                }
            },
            {
                "@@type": "Service",
                "serviceType": "AI & Machine Learning Integration",
                "provider": {
                    "@@id": "https://histone.com.pk/#organization"
                },
                "description": "OpenAI GPT-4, Claude API, LangChain, RAG systems, AI chatbot development, and semantic search implementation.",
                "areaServed": ["Global"],
                "offers": {
                    "@@type": "Offer",
                    "priceRange": "$$$",
                    "priceCurrency": "USD",
                    "availability": "https://schema.org/InStock"
                }
            },
            {
                "@@type": "Service",
                "serviceType": "Full Stack SaaS Development",
                "provider": {
                    "@@id": "https://histone.com.pk/#organization"
                },
                "description": "End-to-end SaaS product development using Laravel, Vue.js, React.js, AWS infrastructure, and scalable multi-tenant architectures.",
                "areaServed": ["Global"],
                "offers": {
                    "@@type": "Offer",
                    "priceRange": "$$$",
                    "priceCurrency": "USD",
                    "availability": "https://schema.org/InStock"
                }
            },
            {
                "@@type": "WebPage",
                "@@id": "https://histone.com.pk/#webpage",
                "url": "https://histone.com.pk",
                "name": "Histone Solutions - Full Stack Development & Amazon SP-API Expert",
                "description": "14+ years of full-stack development expertise. Co-founder of SellerLegend, creator of Forecastly (acquired by Jungle Scout). Specialized in Amazon SP-API, AI/ML integration, and SaaS development.",
                "inLanguage": "en-US",
                "isPartOf": {
                    "@@id": "https://histone.com.pk/#website"
                },
                "about": {
                    "@@id": "https://histone.com.pk/#organization"
                },
                "primaryImageOfPage": {
                    "@@type": "ImageObject",
                    "url": "https://histone.com.pk/assets/images/og-image.jpg"
                }
            },
            {
                "@@type": "WebSite",
                "@@id": "https://histone.com.pk/#website",
                "url": "https://histone.com.pk",
                "name": "Histone Solutions",
                "description": "Full Stack Development & Amazon SP-API Expert",
                "publisher": {
                    "@@id": "https://histone.com.pk/#organization"
                },
                "inLanguage": "en-US"
            },
            {
                "@@type": "FAQPage",
                "mainEntity": [
                    {
                        "@@type": "Question",
                        "name": "What services do you specialize in?",
                        "acceptedAnswer": {
                            "@@type": "Answer",
                            "text": "Histone Solutions specializes in three main areas: Amazon Ecosystem Development (SP-API integration, MWS migration, seller tools), AI & Machine Learning Integration (OpenAI GPT-4, Claude API, LangChain, RAG systems), and Full Stack SaaS Development (PHP Laravel, Python, Vue.js, AWS infrastructure)."
                        }
                    },
                    {
                        "@@type": "Question",
                        "name": "How much does an Amazon SP-API integration project cost?",
                        "acceptedAnswer": {
                            "@@type": "Answer",
                            "text": "Amazon SP-API projects vary based on complexity: Basic Integration (1-2 weeks) costs $2,000-$4,000, Standard Integration (2-4 weeks) costs $4,000-$8,000, and Advanced Solutions (4-8 weeks) cost $8,000-$15,000+. Hourly rate ranges from $20-30/hour."
                        }
                    },
                    {
                        "@@type": "Question",
                        "name": "Can you help migrate from Amazon MWS to SP-API?",
                        "acceptedAnswer": {
                            "@@type": "Answer",
                            "text": "Yes! Histone Solutions has successfully migrated 10+ applications from MWS to SP-API. Our migration process typically takes 4-6 weeks and includes audit, planning, implementation, and testing phases with zero downtime."
                        }
                    },
                    {
                        "@@type": "Question",
                        "name": "What makes your AI integration services different?",
                        "acceptedAnswer": {
                            "@@type": "Answer",
                            "text": "Histone Solutions focuses on practical, ROI-driven AI implementations with production experience processing 500K+ queries/month. We've implemented cost optimizations reducing expenses by 70% and deployed chatbots reducing support tickets by 73%."
                        }
                    }
                ]
            }
        ]
    }
    </script>
@endsection

@section('content')
    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
        <section class="hero" id="home">
            <div class="hero-content">
                <div class="hero-text">
                    <div class="hero-badge">🚀 14+ Years of Excellence</div>
                    <h1>Building Tomorrow's Digital Solutions Today</h1>
                    <p class="hero-subtitle">Enterprise Full Stack Development & SaaS Innovation</p>
                    <p class="hero-description">
                        From startup MVPs to enterprise solutions, we transform complex challenges into scalable, efficient software. Trusted by businesses worldwide with 45,000+ hours of verified expertise delivering cutting-edge Amazon SP-API integrations, AI/ML solutions, and custom SaaS platforms.
                    </p>
                    <div class="hero-buttons">
                        <a href="#contact" class="cta-btn">Start Your Project</a>
                        <a href="#portfolio" class="cta-btn">View Portfolio</a>
                    </div>
                </div>
                <div class="hero-visual">
                    <div class="glass-card">
                        <div class="stats-grid">
                            <div class="stat-item">
                                <span class="stat-number">45K+</span>
                                <span class="stat-label">Verified Hours</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">$915K+</span>
                                <span class="stat-label">Client Value Served</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">100%</span>
                                <span class="stat-label">Success Rate</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">14+</span>
                                <span class="stat-label">Years Experience</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section class="features reveal" id="services">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Core Services</h2>
                    <p class="section-subtitle">Comprehensive solutions for modern businesses</p>
                </div>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">💻</div>
                        <h3 class="feature-title">Full Stack Development</h3>
                        <p class="feature-description">
                            End-to-end application development using PHP, Python, Node.js, and modern frameworks. From architecture design to deployment, ensuring scalable and maintainable solutions.
                        </p>
                        <div class="service-meta">
                            <span class="service-timeline">⏱️ 2-8 weeks</span>
                            <span class="service-rate">💰 $15-30/hr</span>
                        </div>
                        <a href="#contact" class="service-cta">Get Started →</a>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🛍️</div>
                        <h3 class="feature-title">Amazon Ecosystem Expert</h3>
                        <p class="feature-description">
                            8+ years specializing in SP-API, MWS migration, seller tools, and marketplace integration. Built tools managing millions in transactions and inventory.
                        </p>
                        <div class="service-meta">
                            <span class="service-timeline">⏱️ 1-4 weeks</span>
                            <span class="service-rate">💰 $20-30/hr</span>
                        </div>
                        <a href="#contact" class="service-cta">Get Started →</a>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🤖</div>
                        <h3 class="feature-title">AI Integration Services</h3>
                        <p class="feature-description">
                            GPT-4, Claude API, LangChain, RAG systems, chatbot development. Transform your business with cutting-edge AI solutions that reduce costs by 70%+.
                        </p>
                        <div class="service-meta">
                            <span class="service-timeline">⏱️ 2-6 weeks</span>
                            <span class="service-rate">💰 $25-35/hr</span>
                        </div>
                        <a href="#contact" class="service-cta">Get Started →</a>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">☁️</div>
                        <h3 class="feature-title">SaaS Product Development</h3>
                        <p class="feature-description">
                            Co-founded SellerLegend, developed Forecastly (acquired). Expert in multi-tenant architecture, subscription models, and scaling from MVP to enterprise.
                        </p>
                        <div class="service-meta">
                            <span class="service-timeline">⏱️ 4-12 weeks</span>
                            <span class="service-rate">💰 $20-30/hr</span>
                        </div>
                        <a href="#contact" class="service-cta">Get Started →</a>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⚡</div>
                        <h3 class="feature-title">API Integration & Development</h3>
                        <p class="feature-description">
                            RESTful API design, OAuth 2.0 implementation, webhook systems, and third-party integrations. Processed 10M+ monthly API calls with optimal performance.
                        </p>
                        <div class="service-meta">
                            <span class="service-timeline">⏱️ 1-3 weeks</span>
                            <span class="service-rate">💰 $18-28/hr</span>
                        </div>
                        <a href="#contact" class="service-cta">Get Started →</a>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🏗️</div>
                        <h3 class="feature-title">Cloud Architecture & DevOps</h3>
                        <p class="feature-description">
                            AWS expertise with EC2, RDS Aurora, S3, ElastiCache, VPC, and CloudWatch. Infrastructure as Code, CI/CD pipelines, and DevOps best practices.
                        </p>
                        <div class="service-meta">
                            <span class="service-timeline">⏱️ 1-4 weeks</span>
                            <span class="service-rate">💰 $22-32/hr</span>
                        </div>
                        <a href="#contact" class="service-cta">Get Started →</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Solutions We Build Section -->
        <section class="solutions-section reveal" id="solutions">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Enterprise Solutions We Build</h2>
                    <p class="section-subtitle">Production-ready systems built for scalability, performance, and modern business needs</p>
                </div>

                <div class="solutions-grid">
                    <!-- Amazon Seller Tools -->
                    <div class="solution-category">
                        <div class="solution-header">
                            <span class="solution-icon">🛍️</span>
                            <h3>Amazon Seller & E-commerce Tools</h3>
                        </div>
                        <div class="solution-modules">
                            <div class="solution-item">
                                <strong>📊 Real-Time Analytics Dashboards</strong>
                                <p>Multi-marketplace profit tracking, sales analytics, and ROI calculations processing 50,000+ daily transactions with sub-second response times.</p>
                                <span class="tech-stack">Laravel • Vue.js • MySQL • Redis</span>
                            </div>
                            <div class="solution-item">
                                <strong>📦 Inventory Management Systems</strong>
                                <p>Automated FBA sync, multi-channel inventory tracking, restock alerts, and stranded inventory detection across US, EU, and Asia marketplaces.</p>
                                <span class="tech-stack">SP-API • WebSockets • Queues</span>
                            </div>
                            <div class="solution-item">
                                <strong>💰 Repricing & PPC Optimization</strong>
                                <p>Intelligent repricing algorithms, sponsored products management, keyword optimization, and automated bid adjustments processing 500K+ ad impressions daily.</p>
                                <span class="tech-stack">Python • Redis • Celery</span>
                            </div>
                            <div class="solution-item">
                                <strong>🔄 Order & Data Sync Engines</strong>
                                <p>High-performance background processing with Laravel Horizon, handling 10M+ monthly API calls with rate limiting and automatic error recovery.</p>
                                <span class="tech-stack">Laravel Horizon • Redis Queues</span>
                            </div>
                        </div>
                    </div>

                    <!-- AI & Automation Solutions -->
                    <div class="solution-category">
                        <div class="solution-header">
                            <span class="solution-icon">🤖</span>
                            <h3>AI & Intelligent Automation</h3>
                        </div>
                        <div class="solution-modules">
                            <div class="solution-item">
                                <strong>💬 AI Customer Support Chatbots</strong>
                                <p>GPT-4 and Claude-powered support systems reducing ticket volume by 73%, handling 500K+ queries/month with 99.9% uptime and 4.8/5 satisfaction.</p>
                                <span class="tech-stack">OpenAI • Claude • LangChain • Pinecone</span>
                            </div>
                            <div class="solution-item">
                                <strong>🔍 RAG & Knowledge Base Systems</strong>
                                <p>Retrieval-Augmented Generation for intelligent document search, semantic answers, and context-aware responses using vector databases.</p>
                                <span class="tech-stack">LangChain • Pinecone • Embeddings</span>
                            </div>
                            <div class="solution-item">
                                <strong>⚡ AI Cost Optimization Layer</strong>
                                <p>Semantic caching and intelligent model routing reducing OpenAI costs by 70% while maintaining response quality and performance.</p>
                                <span class="tech-stack">Redis • Model Selection • Caching</span>
                            </div>
                            <div class="solution-item">
                                <strong>📧 Intelligent Email & Notification Systems</strong>
                                <p>Smart alert engines for critical events with ML-powered anomaly detection, sending 100K+ emails monthly with 99.5% delivery rate.</p>
                                <span class="tech-stack">Laravel Queues • SES • AI Analysis</span>
                            </div>
                        </div>
                    </div>

                    <!-- SaaS Infrastructure -->
                    <div class="solution-category">
                        <div class="solution-header">
                            <span class="solution-icon">☁️</span>
                            <h3>SaaS Platform Infrastructure</h3>
                        </div>
                        <div class="solution-modules">
                            <div class="solution-item">
                                <strong>💳 Subscription & Billing Systems</strong>
                                <p>Multi-tier subscription management with Stripe, automatic invoicing, usage tracking, prorated billing, and payment failure handling.</p>
                                <span class="tech-stack">Stripe • Laravel Cashier • Webhooks</span>
                            </div>
                            <div class="solution-item">
                                <strong>🔐 Authentication & Security</strong>
                                <p>OAuth 2.0, two-factor authentication, role-based access control, API key management, audit logging, and SOC 2 compliance.</p>
                                <span class="tech-stack">OAuth 2.0 • JWT • 2FA</span>
                            </div>
                            <div class="solution-item">
                                <strong>🗄️ Database Architecture & Scaling</strong>
                                <p>Optimized schemas handling 50M+ records with proper indexing, partitioning, Redis caching reducing queries by 60%, sub-200ms response times.</p>
                                <span class="tech-stack">MySQL • PostgreSQL • Redis • ElastiCache</span>
                            </div>
                            <div class="solution-item">
                                <strong>☁️ AWS Cloud Architecture</strong>
                                <p>Scalable infrastructure with EC2 auto-scaling, RDS Aurora, S3, CloudWatch monitoring, handling traffic spikes during peak seasons.</p>
                                <span class="tech-stack">AWS • Docker • Kubernetes • CI/CD</span>
                            </div>
                        </div>
                    </div>

                    <!-- Modern Web Applications -->
                    <div class="solution-category">
                        <div class="solution-header">
                            <span class="solution-icon">💻</span>
                            <h3>Modern Web Applications</h3>
                        </div>
                        <div class="solution-modules">
                            <div class="solution-item">
                                <strong>📱 Progressive Web Apps (PWA)</strong>
                                <p>Mobile-responsive SPAs with Vue.js/React, real-time updates via WebSockets, lazy loading, code splitting for fast initial load times.</p>
                                <span class="tech-stack">Vue.js 3 • React • Next.js • PWA</span>
                            </div>
                            <div class="solution-item">
                                <strong>📊 Interactive Data Visualization</strong>
                                <p>Custom charting and analytics dashboards with D3.js, supporting 12+ months historical data, real-time updates, and export capabilities.</p>
                                <span class="tech-stack">D3.js • Chart.js • Real-time Data</span>
                            </div>
                            <div class="solution-item">
                                <strong>🔌 RESTful & GraphQL APIs</strong>
                                <p>Well-documented APIs with rate limiting, versioning, authentication, and comprehensive error handling processing millions of requests monthly.</p>
                                <span class="tech-stack">Laravel • Node.js • GraphQL • REST</span>
                            </div>
                            <div class="solution-item">
                                <strong>⚡ Real-Time Collaboration Tools</strong>
                                <p>WebSocket-powered real-time features: live updates, notifications, collaborative editing, and instant synchronization across devices.</p>
                                <span class="tech-stack">WebSockets • Socket.io • Redis Pub/Sub</span>
                            </div>
                        </div>
                    </div>

                    <!-- Data & Analytics -->
                    <div class="solution-category">
                        <div class="solution-header">
                            <span class="solution-icon">📈</span>
                            <h3>Data Processing & Analytics</h3>
                        </div>
                        <div class="solution-modules">
                            <div class="solution-item">
                                <strong>🔄 ETL Pipelines & Data Integration</strong>
                                <p>Automated data extraction, transformation, and loading from multiple sources with error recovery, validation, and data quality monitoring.</p>
                                <span class="tech-stack">Python • Pandas • Apache Airflow</span>
                            </div>
                            <div class="solution-item">
                                <strong>📊 Business Intelligence Dashboards</strong>
                                <p>Executive dashboards with KPIs, trends analysis, predictive analytics, and automated reporting for data-driven decision making.</p>
                                <span class="tech-stack">PowerBI • Tableau • Custom Dashboards</span>
                            </div>
                            <div class="solution-item">
                                <strong>🕷️ Web Scraping & Data Collection</strong>
                                <p>Ethical web scraping solutions with Beautiful Soup, Scrapy, handling dynamic content, CAPTCHAs, and rate limiting for competitive intelligence.</p>
                                <span class="tech-stack">Python • Beautiful Soup • Scrapy • Selenium</span>
                            </div>
                            <div class="solution-item">
                                <strong>⚡ Performance Optimization</strong>
                                <p>Database query optimization, caching strategies, CDN integration, reducing load times by 60% and improving response times to sub-200ms.</p>
                                <span class="tech-stack">Redis • CDN • Query Optimization</span>
                            </div>
                        </div>
                    </div>

                    <!-- Blockchain & Web3 -->
                    <div class="solution-category">
                        <div class="solution-header">
                            <span class="solution-icon">🔗</span>
                            <h3>Blockchain & Modern Technologies</h3>
                        </div>
                        <div class="solution-modules">
                            <div class="solution-item">
                                <strong>💎 Smart Contract Integration</strong>
                                <p>Ethereum and blockchain integration, wallet connectivity, transaction management, and decentralized application backends.</p>
                                <span class="tech-stack">Web3.js • Solidity • Ethereum</span>
                            </div>
                            <div class="solution-item">
                                <strong>🔐 Cryptocurrency Payment Systems</strong>
                                <p>Crypto payment gateways, wallet integration, transaction tracking, and multi-currency support for modern e-commerce platforms.</p>
                                <span class="tech-stack">Blockchain APIs • Crypto Wallets</span>
                            </div>
                            <div class="solution-item">
                                <strong>📱 Mobile-First Applications</strong>
                                <p>Responsive web apps optimized for mobile with touch gestures, offline-first architecture, and native-like performance.</p>
                                <span class="tech-stack">PWA • Service Workers • IndexedDB</span>
                            </div>
                            <div class="solution-item">
                                <strong>🎯 Microservices Architecture</strong>
                                <p>Scalable microservices with Docker, Kubernetes, service mesh, event-driven communication, and independent deployment pipelines.</p>
                                <span class="tech-stack">Docker • Kubernetes • Microservices</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Solution Stats -->
                <div class="solutions-stats">
                    <div class="stat-box">
                        <span class="stat-number">15+</span>
                        <span class="stat-text">SaaS Platforms Built</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">10M+</span>
                        <span class="stat-text">API Calls/Month</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">50M+</span>
                        <span class="stat-text">Records Processed</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">99.9%</span>
                        <span class="stat-text">Uptime SLA</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Expertise Section -->
        <section class="expertise reveal" id="expertise">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Technical Expertise</h2>
                    <p class="section-subtitle">Proven skills across 52+ delivered projects</p>
                </div>

                <!-- Specialized Expertise Areas -->
                <div class="expertise-categories">
                    <!-- Row 1 -->
                    <div class="expertise-category">
                        <h3 class="category-title">Amazon Ecosystem Mastery</h3>
                        <div class="expertise-detailed">
                            <div class="expertise-item premium"><span class="tech-icon">📦</span><span>MWS to SP-API Migration</span><span class="experience-badge">5+ yrs</span></div>
                            <div class="expertise-item premium"><span class="tech-icon">🏪</span><span>Seller Central Integration</span><span class="experience-badge">7+ yrs</span></div>
                            <div class="expertise-item premium"><span class="tech-icon">📊</span><span>FBA Management</span><span class="experience-badge">6+ yrs</span></div>
                            <div class="expertise-item premium"><span class="tech-icon">💰</span><span>Sponsored Products API</span><span class="experience-badge">4+ yrs</span></div>
                            <div class="expertise-item premium"><span class="tech-icon">🔄</span><span>Order & Inventory Sync</span><span class="experience-badge">7+ yrs</span></div>
                            <div class="expertise-item premium"><span class="tech-icon">💲</span><span>Repricing Algorithms</span><span class="experience-badge">5+ yrs</span></div>
                            <div class="expertise-item premium"><span class="tech-icon">🌍</span><span>Multi-Marketplace Integration</span><span class="experience-badge">6+ yrs</span></div>
                            <div class="expertise-item premium"><span class="tech-icon">📢</span><span>Amazon Advertising API</span><span class="experience-badge">4+ yrs</span></div>
                        </div>
                    </div>

                    <div class="expertise-category">
                        <h3 class="category-title">AI & Machine Learning</h3>
                        <div class="expertise-detailed">
                            <div class="expertise-item premium"><span class="tech-icon">🤖</span><span>OpenAI GPT-4 Integration</span><span class="experience-badge">2+ yrs</span></div>
                            <div class="expertise-item premium"><span class="tech-icon">🧠</span><span>Claude API (Anthropic)</span><span class="experience-badge">2+ yrs</span></div>
                            <div class="expertise-item premium"><span class="tech-icon">⛓️</span><span>LangChain Framework</span><span class="experience-badge">2+ yrs</span></div>
                            <div class="expertise-item premium"><span class="tech-icon">🔍</span><span>RAG Implementation</span><span class="experience-badge">2+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">📌</span><span>Vector Databases (Pinecone)</span><span class="experience-badge">2+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">✨</span><span>Prompt Engineering</span><span class="experience-badge">2+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">💬</span><span>AI Chatbot Development</span><span class="experience-badge">3+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">🔎</span><span>Embeddings & Semantic Search</span><span class="experience-badge">2+ yrs</span></div>
                        </div>
                    </div>

                    <div class="expertise-category">
                        <h3 class="category-title">Backend Development</h3>
                        <div class="expertise-detailed">
                            <div class="expertise-item"><span class="tech-icon">🐘</span><span>PHP (Laravel, CodeIgniter)</span><span class="experience-badge">14+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">🐍</span><span>Python (Flask, Django)</span><span class="experience-badge">8+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">🟢</span><span>Node.js & Express</span><span class="experience-badge">6+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">🔌</span><span>RESTful API Design</span><span class="experience-badge">12+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">📊</span><span>GraphQL APIs</span><span class="experience-badge">3+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">🏗️</span><span>Microservices Architecture</span><span class="experience-badge">5+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">🔐</span><span>OAuth 2.0 & JWT</span><span class="experience-badge">8+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">⚡</span><span>WebSocket & Real-time</span><span class="experience-badge">6+ yrs</span></div>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="expertise-category">
                        <h3 class="category-title">Cloud & Infrastructure</h3>
                        <div class="expertise-detailed">
                            <div class="expertise-item"><span class="tech-icon">☁️</span><span>AWS (EC2, RDS, S3)</span><span class="experience-badge">10+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">⚡</span><span>ElastiCache & Redis</span><span class="experience-badge">7+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">📈</span><span>CloudWatch & SQS</span><span class="experience-badge">6+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">🔒</span><span>VPC & Security Groups</span><span class="experience-badge">8+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">📊</span><span>Auto-scaling & Load Balancing</span><span class="experience-badge">7+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">🔄</span><span>CI/CD Pipelines</span><span class="experience-badge">6+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">🐳</span><span>Docker & Kubernetes</span><span class="experience-badge">5+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">⚙️</span><span>Server Optimization</span><span class="experience-badge">12+ yrs</span></div>
                        </div>
                    </div>

                    <div class="expertise-category">
                        <h3 class="category-title">Frontend & UI/UX</h3>
                        <div class="expertise-detailed">
                            <div class="expertise-item"><span class="tech-icon">💚</span><span>Vue.js & Nuxt.js</span><span class="experience-badge">6+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">⚛️</span><span>React.js & Next.js</span><span class="experience-badge">5+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">🎨</span><span>Tailwind CSS</span><span class="experience-badge">4+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">🅱️</span><span>Bootstrap 5</span><span class="experience-badge">10+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">🟨</span><span>JavaScript ES6+</span><span class="experience-badge">12+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">🔷</span><span>TypeScript</span><span class="experience-badge">4+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">📱</span><span>Responsive Design</span><span class="experience-badge">12+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">📲</span><span>Progressive Web Apps</span><span class="experience-badge">5+ yrs</span></div>
                        </div>
                    </div>

                    <div class="expertise-category">
                        <h3 class="category-title">Data & Analytics</h3>
                        <div class="expertise-detailed">
                            <div class="expertise-item"><span class="tech-icon">🗄️</span><span>MySQL & PostgreSQL</span><span class="experience-badge">14+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">🍃</span><span>MongoDB & NoSQL</span><span class="experience-badge">7+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">📊</span><span>Big Data Processing</span><span class="experience-badge">5+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">📈</span><span>Business Intelligence</span><span class="experience-badge">8+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">🕷️</span><span>Web Scraping (Beautiful Soup)</span><span class="experience-badge">6+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">📉</span><span>Data Visualization (D3.js)</span><span class="experience-badge">4+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">🔄</span><span>ETL Pipelines</span><span class="experience-badge">6+ yrs</span></div>
                            <div class="expertise-item"><span class="tech-icon">⚡</span><span>Performance Optimization</span><span class="experience-badge">12+ yrs</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Portfolio Section -->
        <section class="portfolio reveal" id="portfolio">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Portfolio & Client Success</h2>
                    <p class="section-subtitle">52+ successful projects delivered across industries</p>
                </div>

                <!-- Key Projects -->
                <div class="portfolio-showcase">
                    <div class="showcase-item highlight">
                        <div class="showcase-badge">🏆 Acquired by Jungle Scout</div>
                        <h3>Forecastly</h3>
                        <p class="showcase-description">
                            Revolutionary predictive analytics tool for Amazon sellers. Built from ground up with advanced ML models for inventory forecasting, demand prediction, and profit optimization. Successfully acquired by industry leader Jungle Scout in 2018.
                        </p>
                        <div class="tech-tags">
                            <span class="tag">Python</span>
                            <span class="tag">Machine Learning</span>
                            <span class="tag">Amazon SP-API</span>
                            <span class="tag">AWS</span>
                        </div>
                    </div>

                    <div class="showcase-item highlight">
                        <div class="showcase-badge">🚀 Co-Founder & Lead Developer</div>
                        <h3>SellerLegend - Complete Amazon Seller Analytics Platform</h3>
                        <p class="showcase-description">
                            Our team co-founded and built SellerLegend from the ground up - a comprehensive Amazon seller analytics SaaS platform serving 5,000+ active users and tracking $50M+ monthly GMV. We designed and developed the entire platform including real-time profit dashboards, inventory management, PPC optimization, multi-marketplace SP-API integration, subscription billing with Stripe, and scalable AWS infrastructure. Processes 10M+ API calls monthly with 99.9% uptime.
                        </p>
                        <div class="tech-tags">
                            <span class="tag">Laravel 8-10</span>
                            <span class="tag">Vue.js 3</span>
                            <span class="tag">MySQL 8</span>
                            <span class="tag">Redis</span>
                            <span class="tag">AWS RDS Aurora</span>
                            <span class="tag">ElastiCache</span>
                            <span class="tag">Amazon SP-API</span>
                            <span class="tag">Stripe</span>
                            <span class="tag">Laravel Horizon</span>
                            <span class="tag">D3.js</span>
                        </div>
                    </div>

                    <div class="showcase-item highlight">
                        <div class="showcase-badge">💎 Core Developer</div>
                        <h3>AMZShark</h3>
                        <p class="showcase-description">
                            Advanced repricing software for Amazon sellers. Developed core algorithms for competitive pricing, inventory sync, and automated repricing strategies. Handles 10M+ API calls monthly.
                        </p>
                        <div class="tech-tags">
                            <span class="tag">Python Flask</span>
                            <span class="tag">Bootstrap</span>
                            <span class="tag">Amazon MWS</span>
                            <span class="tag">Redis Queue</span>
                        </div>
                    </div>
                </div>

                <!-- Client Projects Grid -->
                <h3 class="subsection-title">Enterprise Client Projects</h3>
                <div class="client-grid">
                    <div class="client-card">
                        <div class="client-header">
                            <h4>Honest Office</h4>
                            <span class="project-count">5 Projects</span>
                        </div>
                        <p class="client-description">
                            Complete ERP system development with Amazon MWS integration. Built custom inventory management, order processing, and automated reporting systems.
                        </p>
                        <div class="project-highlights">
                            <span>• ERP Development</span>
                            <span>• MWS API Integration</span>
                            <span>• System Architecture</span>
                        </div>
                    </div>

                    <div class="client-card">
                        <div class="client-header">
                            <h4>Planet3</h4>
                            <span class="project-count">3 Major Projects</span>
                        </div>
                        <p class="client-description">
                            Developed marketplace platform similar to Fiverr and advanced Amazon repricing software using Python/Flask architecture.
                        </p>
                        <div class="project-highlights">
                            <span>• Marketplace Development</span>
                            <span>• Repricing Algorithms</span>
                            <span>• Flask Backend</span>
                        </div>
                    </div>

                    <div class="client-card">
                        <div class="client-header">
                            <h4>Maxton & Company</h4>
                            <span class="project-count">Intelligence Platform</span>
                        </div>
                        <p class="client-description">
                            Built comprehensive Amazon sales intelligence dashboard with advanced analytics, competitor tracking, and market insights.
                        </p>
                        <div class="project-highlights">
                            <span>• Business Intelligence</span>
                            <span>• Data Visualization</span>
                            <span>• API Development</span>
                        </div>
                    </div>

                    <div class="client-card">
                        <div class="client-header">
                            <h4>Marketplace Clicks</h4>
                            <span class="project-count">4 Projects</span>
                        </div>
                        <p class="client-description">
                            Automated report generation, database optimization, and API integration support for large-scale e-commerce operations.
                        </p>
                        <div class="project-highlights">
                            <span>• Automation Tools</span>
                            <span>• Database Management</span>
                            <span>• API Support</span>
                        </div>
                    </div>

                    <div class="client-card">
                        <div class="client-header">
                            <h4>Boardwest</h4>
                            <span class="project-count">Scraping & Integration</span>
                        </div>
                        <p class="client-description">
                            Developed advanced web scraping tools with direct Amazon and eBay integration for automated product listing and inventory sync.
                        </p>
                        <div class="project-highlights">
                            <span>• Web Scraping</span>
                            <span>• Multi-marketplace</span>
                            <span>• Automation</span>
                        </div>
                    </div>

                    <div class="client-card">
                        <div class="client-header">
                            <h4>TAC Digital</h4>
                            <span class="project-count">AWS Infrastructure</span>
                        </div>
                        <p class="client-description">
                            Complete AWS infrastructure setup and optimization for high-traffic Amazon seller tools with auto-scaling capabilities.
                        </p>
                        <div class="project-highlights">
                            <span>• AWS Architecture</span>
                            <span>• Cloud Migration</span>
                            <span>• Performance Tuning</span>
                        </div>
                    </div>
                </div>

                <!-- Project Stats -->
                <div class="project-stats">
                    <div class="stat-card">
                        <span class="stat-icon">📊</span>
                        <span class="stat-value">26</span>
                        <span class="stat-label">Amazon/SP-API Projects</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-icon">🔌</span>
                        <span class="stat-value">14</span>
                        <span class="stat-label">API Integrations</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-icon">🐍</span>
                        <span class="stat-value">5</span>
                        <span class="stat-label">Python/Flask Systems</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-icon">💰</span>
                        <span class="stat-value">$11-30</span>
                        <span class="stat-label">Hourly Rate Range</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="testimonials reveal" id="testimonials">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Client Testimonials</h2>
                    <p class="section-subtitle">Hear from clients who've trusted us with their projects</p>
                </div>

                <!-- Testimonial Slider -->
                <div class="testimonial-slider">
                    <div class="testimonial-track">
                        <!-- Testimonial 1 -->
                        <div class="testimonial-slide">
                            <div class="testimonial-card">
                                <div class="quote-icon">"</div>
                                <div class="testimonial-content">
                                    <div class="star-rating">
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                    </div>
                                    <p class="testimonial-text">
                                        "Awais is an exceptional developer with deep expertise in Amazon SP-API integration. He built our entire seller analytics platform from scratch, handling millions of transactions monthly with zero downtime. His technical skills and problem-solving abilities are outstanding."
                                    </p>
                                </div>
                                <div class="testimonial-author">
                                    <div class="author-avatar">JM</div>
                                    <div class="author-info">
                                        <div class="author-name">John Matthews</div>
                                        <div class="author-title">CEO</div>
                                        <div class="author-company">SellerLegend</div>
                                        <div class="verified-badge">
                                            <span class="verified-icon">✓</span>
                                            <span>Verified Client</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 2 -->
                        <div class="testimonial-slide">
                            <div class="testimonial-card">
                                <div class="quote-icon">"</div>
                                <div class="testimonial-content">
                                    <div class="star-rating">
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                    </div>
                                    <p class="testimonial-text">
                                        "Working with Awais on our ERP system was a game-changer. He understood our complex requirements and delivered a robust solution that integrated seamlessly with Amazon MWS. His attention to detail and commitment to quality is impressive."
                                    </p>
                                </div>
                                <div class="testimonial-author">
                                    <div class="author-avatar">DH</div>
                                    <div class="author-info">
                                        <div class="author-name">David Harrison</div>
                                        <div class="author-title">Operations Director</div>
                                        <div class="author-company">Honest Office</div>
                                        <div class="verified-badge">
                                            <span class="verified-icon">✓</span>
                                            <span>Verified Client</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 3 -->
                        <div class="testimonial-slide">
                            <div class="testimonial-card">
                                <div class="quote-icon">"</div>
                                <div class="testimonial-content">
                                    <div class="star-rating">
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                    </div>
                                    <p class="testimonial-text">
                                        "Awais delivered our marketplace platform ahead of schedule with exceptional quality. His expertise in Python/Flask and ability to architect scalable solutions made him the perfect choice for our project. Highly recommended!"
                                    </p>
                                </div>
                                <div class="testimonial-author">
                                    <div class="author-avatar">SP</div>
                                    <div class="author-info">
                                        <div class="author-name">Sarah Peterson</div>
                                        <div class="author-title">Product Manager</div>
                                        <div class="author-company">Planet3</div>
                                        <div class="verified-badge">
                                            <span class="verified-icon">✓</span>
                                            <span>Verified Client</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 4 -->
                        <div class="testimonial-slide">
                            <div class="testimonial-card">
                                <div class="quote-icon">"</div>
                                <div class="testimonial-content">
                                    <div class="star-rating">
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                    </div>
                                    <p class="testimonial-text">
                                        "The AWS infrastructure setup Awais created for us handles massive traffic with ease. His knowledge of cloud architecture, auto-scaling, and optimization techniques saved us thousands in operational costs. A true professional."
                                    </p>
                                </div>
                                <div class="testimonial-author">
                                    <div class="author-avatar">MR</div>
                                    <div class="author-info">
                                        <div class="author-name">Michael Roberts</div>
                                        <div class="author-title">CTO</div>
                                        <div class="author-company">TAC Digital</div>
                                        <div class="verified-badge">
                                            <span class="verified-icon">✓</span>
                                            <span>Verified Client</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 5 -->
                        <div class="testimonial-slide">
                            <div class="testimonial-card">
                                <div class="quote-icon">"</div>
                                <div class="testimonial-content">
                                    <div class="star-rating">
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                    </div>
                                    <p class="testimonial-text">
                                        "Outstanding work on our sales intelligence dashboard. Awais transformed complex data into actionable insights with beautiful visualizations. His API development skills and business understanding set him apart from other developers."
                                    </p>
                                </div>
                                <div class="testimonial-author">
                                    <div class="author-avatar">EC</div>
                                    <div class="author-info">
                                        <div class="author-name">Emily Chen</div>
                                        <div class="author-title">Head of Analytics</div>
                                        <div class="author-company">Maxton & Company</div>
                                        <div class="verified-badge">
                                            <span class="verified-icon">✓</span>
                                            <span>Verified Client</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slider Navigation -->
                    <div class="slider-nav">
                        <button class="slider-btn slider-prev" aria-label="Previous testimonial">‹</button>
                        <button class="slider-btn slider-next" aria-label="Next testimonial">›</button>
                    </div>

                    <!-- Slider Dots (Mobile) -->
                    <div class="slider-dots"></div>

                    <!-- Scroll Indicator (Desktop) -->
                    <div class="scroll-indicator">← Scroll or use arrows to see more →</div>
                </div>

                <!-- Client Logos -->
                <div class="client-logos">
                    <h4 class="logos-title">Trusted by Leading Companies</h4>
                    <div class="logos-grid">
                        <div class="logo-item">
                            <div style="font-weight: 600; color: var(--text-primary);">SellerLegend</div>
                        </div>
                        <div class="logo-item">
                            <div style="font-weight: 600; color: var(--text-primary);">Honest Office</div>
                        </div>
                        <div class="logo-item">
                            <div style="font-weight: 600; color: var(--text-primary);">Planet3</div>
                        </div>
                        <div class="logo-item">
                            <div style="font-weight: 600; color: var(--text-primary);">Maxton & Co.</div>
                        </div>
                        <div class="logo-item">
                            <div style="font-weight: 600; color: var(--text-primary);">TAC Digital</div>
                        </div>
                        <div class="logo-item">
                            <div style="font-weight: 600; color: var(--text-primary);">AMZShark</div>
                        </div>
                    </div>
                </div>

                <!-- Trust Indicators -->
                <div class="trust-indicators">
                    <div class="trust-card">
                        <div class="trust-icon">🏆</div>
                        <div class="trust-badge">Top Rated Plus</div>
                        <h4 class="trust-title">Upwork Top Rated</h4>
                        <p class="trust-description">
                            Consistently delivering exceptional work with 100% job success score on invited projects
                        </p>
                    </div>

                    <div class="trust-card">
                        <div class="trust-icon">🎯</div>
                        <div class="trust-badge">100% Success</div>
                        <h4 class="trust-title">Perfect Track Record</h4>
                        <p class="trust-description">
                            Every project delivered on time, on budget, and exceeding client expectations
                        </p>
                    </div>

                    <div class="trust-card">
                        <div class="trust-icon">🚀</div>
                        <div class="trust-badge">Exit Success</div>
                        <h4 class="trust-title">Proven Builder</h4>
                        <p class="trust-description">
                            Built Forecastly from scratch and successfully sold to Jungle Scout in 2018
                        </p>
                    </div>

                    <div class="trust-card">
                        <div class="trust-icon">⚡</div>
                        <div class="trust-badge">45K+ Hours</div>
                        <h4 class="trust-title">Verified Expertise</h4>
                        <p class="trust-description">
                            45,000+ billable hours across 52 successful projects with top-tier clients
                        </p>
                    </div>
                </div>

                <!-- Platform Badges -->
                <div class="platform-badges">
                    <div class="platform-badge">
                        <div class="platform-icon">💼</div>
                        <div class="platform-info">
                            <div class="platform-name">Upwork</div>
                            <div class="platform-rating">
                                Top Rated Plus
                                <span class="platform-stars">★★★★★</span>
                            </div>
                        </div>
                    </div>

                    <div class="platform-badge">
                        <div class="platform-icon">🌐</div>
                        <div class="platform-info">
                            <div class="platform-name">Client Reviews</div>
                            <div class="platform-rating">
                                5.0 Average
                                <span class="platform-stars">★★★★★</span>
                            </div>
                        </div>
                    </div>

                    <div class="platform-badge">
                        <div class="platform-icon">✅</div>
                        <div class="platform-info">
                            <div class="platform-name">Success Rate</div>
                            <div class="platform-rating">
                                100% Completion
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="faq-section reveal" id="faq">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Frequently Asked Questions</h2>
                    <p class="section-subtitle">Get answers to common questions about our services and expertise</p>
                </div>

                <div class="faq-container">
                    <div class="faq-item">
                        <button class="faq-question">
                            <span>What services do you specialize in?</span>
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-answer">
                            <p>We specialize in three main areas with over 14 years of hands-on experience:</p>
                            <ul>
                                <li><strong>Amazon Ecosystem Development:</strong> SP-API integration, MWS to SP-API migration, seller tools, FBA management systems, repricing algorithms, and multi-marketplace integration. We've built tools managing millions of dollars in Amazon transactions.</li>
                                <li><strong>AI & Machine Learning Integration:</strong> OpenAI GPT-4, Claude API, LangChain framework, RAG (Retrieval-Augmented Generation) systems, AI chatbots, and semantic search. Recent projects include reducing customer support costs by 70% through intelligent AI automation.</li>
                                <li><strong>Full Stack SaaS Development:</strong> PHP (Laravel, CodeIgniter), Python (Flask, Django), Vue.js, React.js, AWS infrastructure, and scalable multi-tenant architectures. Co-founded SellerLegend and built Forecastly from ground up.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>How much does an Amazon SP-API integration project cost?</span>
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-answer">
                            <p>Amazon SP-API projects vary based on complexity and scope. Here's a typical breakdown:</p>
                            <ul>
                                <li><strong>Basic Integration (1-2 weeks):</strong> $2,000 - $4,000 - Simple order sync, inventory updates, basic reporting</li>
                                <li><strong>Standard Integration (2-4 weeks):</strong> $4,000 - $8,000 - Multi-marketplace support, FBA integration, sponsored products API, repricing</li>
                                <li><strong>Advanced Solution (4-8 weeks):</strong> $8,000 - $15,000+ - Complete seller tool with analytics, forecasting, automated workflows, custom algorithms</li>
                            </ul>
                            <p>Our hourly rate ranges from $20-30/hour depending on project complexity. We provide detailed estimates after understanding your specific requirements and can work on both fixed-price and hourly basis.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Can you help migrate from Amazon MWS to SP-API?</span>
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-answer">
                            <p>Yes! We've successfully migrated 10+ applications from MWS to SP-API. The migration process typically involves:</p>
                            <ol>
                                <li><strong>Audit (Week 1):</strong> Review existing MWS implementation, identify all API calls, data dependencies, and business logic</li>
                                <li><strong>Planning (Week 1-2):</strong> Map MWS endpoints to SP-API equivalents, plan OAuth 2.0 implementation, design new architecture</li>
                                <li><strong>Implementation (Week 2-4):</strong> Build new SP-API integration, implement LWA (Login with Amazon), migrate data flows</li>
                                <li><strong>Testing & Deployment (Week 4-5):</strong> Parallel testing, validation, staged rollout to minimize disruption</li>
                            </ol>
                            <p>We ensure zero downtime during migration and maintain backward compatibility where needed. Average timeline: 4-6 weeks depending on application complexity.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>What makes your AI integration services different?</span>
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-answer">
                            <p>We focus on practical, ROI-driven AI implementations rather than experimental projects. Key differentiators:</p>
                            <ul>
                                <li><strong>Production Experience:</strong> Built AI systems processing 500K+ queries/month with 99.9% uptime</li>
                                <li><strong>Cost Optimization:</strong> Implemented semantic caching and intelligent model routing that reduced costs by 70% for clients</li>
                                <li><strong>Real Results:</strong> Deployed chatbots that reduced support tickets by 73% while maintaining 4.8/5 customer satisfaction</li>
                                <li><strong>Multi-Model Expertise:</strong> Work with OpenAI GPT-4, Claude, and open-source models - choosing the right tool for your budget and requirements</li>
                                <li><strong>End-to-End Implementation:</strong> From prompt engineering to production deployment, monitoring, and continuous improvement</li>
                            </ul>
                            <p>We provide realistic timelines, transparent pricing, and measurable KPIs for every AI project.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Do you work with startups or only established companies?</span>
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-answer">
                            <p>We work with both! Our experience spans from early-stage startups to enterprise clients:</p>
                            <ul>
                                <li><strong>Startups & MVPs:</strong> Helped launch 15+ SaaS products from scratch. We understand lean development, quick iterations, and building for scalability from day one. Can work with equity + cash arrangements for promising projects.</li>
                                <li><strong>Growing Businesses:</strong> Ideal for companies scaling from 100 to 10,000+ users. We've optimized systems handling millions of API calls and designed architectures that scale horizontally.</li>
                                <li><strong>Enterprise Clients:</strong> Worked with established businesses like Honest Office, Planet3, and Maxton on mission-critical integrations and infrastructure.</li>
                            </ul>
                            <p>Minimum project size: $1,500. Preferred project duration: 2-12 weeks for focused delivery and maximum impact.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>What's your development process and communication style?</span>
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-answer">
                            <p>We follow an agile, transparent development approach:</p>
                            <ol>
                                <li><strong>Discovery (Week 1):</strong> Detailed requirements gathering, technical specification, timeline and cost estimate</li>
                                <li><strong>Architecture & Planning:</strong> Design system architecture, database schema, API contracts, and deployment strategy</li>
                                <li><strong>Iterative Development:</strong> Weekly sprints with deployable increments, regular demos, and feedback incorporation</li>
                                <li><strong>Quality Assurance:</strong> Code reviews, automated testing, performance optimization, and security audits</li>
                                <li><strong>Deployment & Support:</strong> Staged rollout, monitoring setup, documentation, and 30-day post-launch support</li>
                            </ol>
                            <p><strong>Communication:</strong> Daily updates via Slack/email, weekly video calls, shared project board (Trello/Jira), and detailed documentation. Timezone flexible - we work across US, EU, and Asia-Pacific hours.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Can you help with ongoing maintenance and support?</span>
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-answer">
                            <p>Absolutely! We offer flexible maintenance and support options:</p>
                            <ul>
                                <li><strong>Retainer Packages:</strong> 10-40 hours/month for ongoing development, bug fixes, and feature additions. Ideal for active projects requiring continuous improvement.</li>
                                <li><strong>On-Demand Support:</strong> Pay-as-you-go hourly rate for occasional updates, emergency fixes, or small enhancements.</li>
                                <li><strong>Monitoring & DevOps:</strong> Server monitoring, performance optimization, security patches, and infrastructure management.</li>
                            </ul>
                            <p>All projects include 30 days of free post-launch support covering bug fixes and minor adjustments. We maintain long-term relationships with clients - many have been working with me for 3-5+ years.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>What technologies and frameworks do you work with?</span>
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-answer">
                            <p>We have deep expertise across the full technology stack:</p>
                            <ul>
                                <li><strong>Backend:</strong> PHP (Laravel 8-11, CodeIgniter), Python (Flask, Django), Node.js (Express), RESTful APIs, GraphQL, WebSockets</li>
                                <li><strong>Frontend:</strong> Vue.js 3, React.js, Nuxt.js, Next.js, Tailwind CSS, Bootstrap 5, vanilla JavaScript ES6+</li>
                                <li><strong>Databases:</strong> MySQL, PostgreSQL, MongoDB, Redis, ElastiCache, database optimization and scaling</li>
                                <li><strong>Cloud & DevOps:</strong> AWS (EC2, RDS, S3, Lambda, CloudWatch, SQS), Docker, Kubernetes, CI/CD pipelines, Infrastructure as Code</li>
                                <li><strong>AI/ML:</strong> OpenAI API, Claude API, LangChain, Pinecone, Hugging Face, prompt engineering, RAG systems</li>
                                <li><strong>Amazon:</strong> SP-API, MWS, Seller Central, FBA, Advertising API, OAuth 2.0, LWA</li>
                            </ul>
                            <p>We choose technologies based on project requirements, team expertise, and long-term maintainability - not trends or personal preferences.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Where are you located and what are your working hours?</span>
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-answer">
                            <p>We're based in Rawalpindi, Pakistan (GMT+5 timezone) and work with clients globally:</p>
                            <ul>
                                <li><strong>Primary Hours:</strong> 9 AM - 6 PM PKT (Pakistan Time), Monday to Friday</li>
                                <li><strong>Flexible Availability:</strong> Can adjust schedule for US (EST/PST) and European (CET) clients with 4-6 hours overlap</li>
                                <li><strong>Communication:</strong> Available via Slack, email, and scheduled video calls. Respond to urgent messages within 2-4 hours during business days</li>
                                <li><strong>Remote Work:</strong> 100% remote since 2011. Experienced in distributed team collaboration, async communication, and delivering quality work without office oversight</li>
                            </ul>
                            <p>We've successfully delivered 52+ projects for international clients across USA, UK, Australia, Germany, and UAE with zero timezone-related issues.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>How do we get started with a project?</span>
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-answer">
                            <p>Getting started is simple and straightforward:</p>
                            <ol>
                                <li><strong>Initial Contact:</strong> Fill out the contact form below or email us at info@histone.com.pk with your project details</li>
                                <li><strong>Discovery Call (30-60 min):</strong> Free consultation to understand your requirements, goals, timeline, and budget</li>
                                <li><strong>Proposal (2-3 days):</strong> Detailed technical proposal with architecture overview, timeline, milestones, and cost breakdown</li>
                                <li><strong>Agreement:</strong> Sign contract/SOW, set up communication channels (Slack/Trello), and make initial payment (usually 30-50% upfront)</li>
                                <li><strong>Kickoff:</strong> Start development within 1-3 days, begin first sprint, and establish regular check-in schedule</li>
                            </ol>
                            <p>Most projects start within one week of initial contact. Rush projects can begin within 24-48 hours if requirements are clear.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Banner Section -->
        <section class="cta-banner reveal">
            <div class="container">
                <div class="cta-box">
                    <h2 class="cta-title">Let's Discuss Your Next Project</h2>
                    <p class="cta-description">
                        Whether you need Amazon SP-API integration, AI chatbot development, or full-stack SaaS solutions, We're here to help you succeed.
                    </p>
                    <div class="cta-buttons">
                        <a href="#contact" class="cta-button primary">Start a Project</a>
                        <a href="https://www.linkedin.com/in/awaisnaseem/" target="_blank" rel="noopener" class="cta-button secondary">View LinkedIn Profile</a>
                    </div>
                    <div class="cta-stats">
                        <div class="cta-stat">
                            <span class="stat-number">52+</span>
                            <span class="stat-label">Projects Delivered</span>
                        </div>
                        <div class="cta-stat">
                            <span class="stat-number">100%</span>
                            <span class="stat-label">Success Rate</span>
                        </div>
                        <div class="cta-stat">
                            <span class="stat-number">14+</span>
                            <span class="stat-label">Years Experience</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Form Section -->
        <section class="cta-section reveal" id="contact">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Ready to Build Something Amazing?</h2>
                    <p class="section-subtitle">Let's transform your vision into reality with proven expertise and innovative solutions</p>
                </div>

                <div class="contact-form-wrapper">
                    <form id="contact-form" class="contact-form" method="POST" action="api/contact.php">
                        <!-- Honeypot for spam protection -->
                        <input type="text" name="website" class="form-honeypot" tabindex="-1" autocomplete="off">

                        <div class="form-row">
                            <div class="form-group">
                                <label for="name" class="form-label required">Your Name</label>
                                <input type="text" id="name" name="name" class="form-input" placeholder="John Doe" required>
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label required">Email Address</label>
                                <input type="email" id="email" name="email" class="form-input" placeholder="john@company.com" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" id="phone" name="phone" class="form-input" placeholder="+1 (555) 123-4567">
                            </div>

                            <div class="form-group">
                                <label for="company" class="form-label">Company Name</label>
                                <input type="text" id="company" name="company" class="form-input" placeholder="Your Company Inc.">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="project_type" class="form-label">Project Type</label>
                                <select id="project_type" name="project_type" class="form-select">
                                    <option value="other">Select Project Type</option>
                                    <option value="amazon_integration">Amazon SP-API Integration</option>
                                    <option value="saas_development">SaaS Development</option>
                                    <option value="api_development">API Development</option>
                                    <option value="ai_integration">AI/ML Integration</option>
                                    <option value="consultation">Technical Consultation</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                        </div>

                        <div class="form-row full">
                            <div class="form-group">
                                <label for="timeline" class="form-label">Timeline</label>
                                <select id="timeline" name="timeline" class="form-select">
                                    <option value="flexible">Select Timeline</option>
                                    <option value="urgent">Urgent (ASAP)</option>
                                    <option value="within_month">Within a Month</option>
                                    <option value="within_3months">Within 3 Months</option>
                                    <option value="flexible">Flexible</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row full">
                            <div class="form-group">
                                <label for="message" class="form-label required">Tell Us About Your Project</label>
                                <textarea id="message" name="message" class="form-textarea" placeholder="Describe your project requirements, goals, and any specific challenges you're facing..." required></textarea>
                            </div>
                        </div>

                        <div class="form-checkbox-group">
                            <input type="checkbox" id="subscribe" name="subscribe" class="form-checkbox">
                            <label for="subscribe" class="checkbox-label">
                                Yes, I'd like to receive updates about new articles and development insights
                            </label>
                        </div>

                        <button type="submit" class="form-submit">Send Message</button>

                        <div class="form-footer">
                            We typically respond within 24 hours. By submitting this form, you agree to our
                            <a href="#privacy">privacy policy</a>.
                        </div>
                    </form>

                    <!-- Alternative Contact Methods -->
                    <div class="contact-alternatives">
                        <div class="alternatives-title">Or reach us directly</div>
                        <div class="alternatives-grid">
                            <div class="alternative-item">
                                <div class="alternative-icon">📧</div>
                                <div class="alternative-label">Email</div>
                                <div class="alternative-value">
                                    <a href="mailto:info@histone.com.pk">info@histone.com.pk</a>
                                </div>
                            </div>

                            <div class="alternative-item">
                                <div class="alternative-icon">📞</div>
                                <div class="alternative-label">Phone</div>
                                <div class="alternative-value">
                                    <a href="tel:+925183594 91">+92 51 8359491</a>
                                </div>
                            </div>

                            <div class="alternative-item">
                                <div class="alternative-icon">💼</div>
                                <div class="alternative-label">LinkedIn</div>
                                <div class="alternative-value">
                                    <a href="https://www.linkedin.com/in/muhammadawaisnaseem/" target="_blank" rel="noopener">Connect with us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
