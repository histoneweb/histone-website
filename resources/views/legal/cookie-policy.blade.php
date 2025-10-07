@extends('layouts.app')

@section('title', 'Cookie Policy - Histone Solutions')
@section('description', 'Cookie Policy for Histone Solutions Private Limited. Learn about the cookies we use and how to manage them.')

@section('content')
<div class="legal-page">
    <div class="legal-container">
        <div class="legal-header">
            <h1>Cookie Policy</h1>
            <p class="legal-updated">Last Updated: January 7, 2025</p>
        </div>

        <div class="legal-content">
            <section class="legal-section">
                <h2>1. What Are Cookies</h2>
                <p>Cookies are small text files that are placed on your computer or mobile device when you visit a website. They are widely used to make websites work more efficiently, provide a better user experience, and provide information to website owners.</p>
                <p>This Cookie Policy explains what cookies are, how we use them on the Histone Solutions website (<a href="https://histone.com.pk">histone.com.pk</a>), and how you can manage your cookie preferences.</p>
            </section>

            <section class="legal-section">
                <h2>2. How We Use Cookies</h2>
                <p>Histone Solutions uses cookies and similar tracking technologies for the following purposes:</p>
                <ul>
                    <li><strong>Essential Operation:</strong> Enabling core website functionality and security features</li>
                    <li><strong>Performance and Analytics:</strong> Understanding how visitors use our website to improve user experience</li>
                    <li><strong>Functionality:</strong> Remembering your preferences and settings</li>
                    <li><strong>Marketing:</strong> Delivering relevant content and advertisements (if applicable)</li>
                </ul>
            </section>

            <section class="legal-section">
                <h2>3. Types of Cookies We Use</h2>

                <h3>3.1 Strictly Necessary Cookies</h3>
                <p>These cookies are essential for the website to function properly and cannot be disabled in our systems. They are usually only set in response to actions you take, such as setting your privacy preferences, logging in, or filling in forms.</p>
                <table class="cookie-table">
                    <thead>
                        <tr>
                            <th>Cookie Name</th>
                            <th>Purpose</th>
                            <th>Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>cookie_consent</td>
                            <td>Stores your cookie consent preferences</td>
                            <td>1 year</td>
                        </tr>
                        <tr>
                            <td>XSRF-TOKEN</td>
                            <td>Security token to prevent cross-site request forgery attacks</td>
                            <td>Session</td>
                        </tr>
                        <tr>
                            <td>laravel_session</td>
                            <td>Maintains user session state</td>
                            <td>Session</td>
                        </tr>
                    </tbody>
                </table>

                <h3>3.2 Performance and Analytics Cookies</h3>
                <p>These cookies help us understand how visitors interact with our website by collecting and reporting information anonymously. This helps us improve our website's performance and content.</p>
                <p><strong>We may use:</strong></p>
                <ul>
                    <li><strong>Google Analytics:</strong> To analyze website traffic and user behavior</li>
                    <li><strong>Hotjar or Similar Tools:</strong> To understand user interactions and improve UX (if implemented)</li>
                </ul>

                <h3>3.3 Functionality Cookies</h3>
                <p>These cookies enable enhanced functionality and personalization, such as remembering your preferences (e.g., theme selection, language).</p>
                <table class="cookie-table">
                    <thead>
                        <tr>
                            <th>Cookie Name</th>
                            <th>Purpose</th>
                            <th>Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>theme_preference</td>
                            <td>Remembers your light/dark theme selection</td>
                            <td>1 year</td>
                        </tr>
                    </tbody>
                </table>

                <h3>3.4 Marketing and Targeting Cookies</h3>
                <p>These cookies may be set by our advertising partners to build a profile of your interests and show you relevant ads on other websites. They do not store directly personal information but are based on uniquely identifying your browser and device.</p>
                <p><em>Note: We currently do not use marketing/targeting cookies, but may in the future with your explicit consent.</em></p>
            </section>

            <section class="legal-section">
                <h2>4. Third-Party Cookies</h2>
                <p>In addition to our own cookies, we may use various third-party cookies to report usage statistics and deliver advertisements (if applicable):</p>

                <h3>4.1 Google Analytics</h3>
                <p>We use Google Analytics to understand how users interact with our website. Google Analytics uses cookies to collect information about website usage, which is used to compile reports and help us improve our website.</p>
                <p>The information generated by the cookie about your use of the website (including your IP address) is transmitted to and stored by Google. Google may also transfer this information to third parties where required by law.</p>
                <p>Learn more: <a href="https://policies.google.com/privacy" target="_blank" rel="noopener noreferrer">Google Privacy Policy</a></p>
                <p>Opt-out: <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener noreferrer">Google Analytics Opt-out Browser Add-on</a></p>

                <h3>4.2 Social Media Plugins</h3>
                <p>If our website includes social media sharing buttons (LinkedIn, GitHub), these services may set their own cookies when you interact with them. We do not control these cookies.</p>
            </section>

            <section class="legal-section">
                <h2>5. Cookie Duration</h2>
                <p>Cookies can be categorized by their duration:</p>
                <ul>
                    <li><strong>Session Cookies:</strong> Temporary cookies that expire when you close your browser</li>
                    <li><strong>Persistent Cookies:</strong> Remain on your device for a set period or until you delete them</li>
                </ul>
                <p>Most of our cookies are session cookies, while preference cookies (like theme selection) are persistent to remember your choices across visits.</p>
            </section>

            <section class="legal-section">
                <h2>6. Managing Your Cookie Preferences</h2>

                <h3>6.1 Cookie Consent Banner</h3>
                <p>When you first visit our website, you will see a cookie consent banner allowing you to:</p>
                <ul>
                    <li>Accept all cookies</li>
                    <li>Reject non-essential cookies</li>
                    <li>Customize your cookie preferences</li>
                </ul>
                <p>You can change your preferences at any time by clicking the "Cookie Settings" link in our footer.</p>

                <h3>6.2 Browser Settings</h3>
                <p>Most web browsers allow you to control cookies through their settings. You can typically:</p>
                <ul>
                    <li>View and delete cookies</li>
                    <li>Block cookies from specific websites</li>
                    <li>Block all cookies</li>
                    <li>Clear all cookies when closing the browser</li>
                </ul>
                <p><strong>Common Browser Cookie Settings:</strong></p>
                <ul>
                    <li><a href="https://support.google.com/chrome/answer/95647" target="_blank" rel="noopener noreferrer">Google Chrome</a></li>
                    <li><a href="https://support.mozilla.org/en-US/kb/cookies-information-websites-store-on-your-computer" target="_blank" rel="noopener noreferrer">Mozilla Firefox</a></li>
                    <li><a href="https://support.microsoft.com/en-us/microsoft-edge/delete-cookies-in-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09" target="_blank" rel="noopener noreferrer">Microsoft Edge</a></li>
                    <li><a href="https://support.apple.com/guide/safari/manage-cookies-sfri11471/mac" target="_blank" rel="noopener noreferrer">Safari</a></li>
                </ul>

                <h3>6.3 Impact of Disabling Cookies</h3>
                <p>Please note that disabling certain cookies may affect the functionality of our website. Specifically:</p>
                <ul>
                    <li><strong>Strictly Necessary Cookies:</strong> Cannot be disabled as they are essential for website operation</li>
                    <li><strong>Analytics Cookies:</strong> Disabling these will limit our ability to improve the website based on user behavior</li>
                    <li><strong>Functionality Cookies:</strong> Disabling these means we cannot remember your preferences</li>
                </ul>
            </section>

            <section class="legal-section">
                <h2>7. Do Not Track Signals</h2>
                <p>Some browsers incorporate a "Do Not Track" (DNT) feature that signals to websites you visit that you do not want your online activity tracked. Currently, there is no industry consensus on how to respond to DNT signals, so our website does not respond to DNT browser settings.</p>
            </section>

            <section class="legal-section">
                <h2>8. Updates to This Cookie Policy</h2>
                <p>We may update this Cookie Policy from time to time to reflect changes in our practices, technologies, legal requirements, or other factors. We will notify you of any material changes by posting the updated policy on this page with a new "Last Updated" date.</p>
                <p>We encourage you to review this Cookie Policy periodically to stay informed about our use of cookies.</p>
            </section>

            <section class="legal-section">
                <h2>9. More Information</h2>
                <p>For more information about online privacy and cookies, visit:</p>
                <ul>
                    <li><a href="https://www.allaboutcookies.org/" target="_blank" rel="noopener noreferrer">All About Cookies</a></li>
                    <li><a href="https://ico.org.uk/for-the-public/online/cookies/" target="_blank" rel="noopener noreferrer">UK Information Commissioner's Office</a></li>
                </ul>
            </section>

            <section class="legal-section">
                <h2>10. Contact Us</h2>
                <p>If you have questions or concerns about our use of cookies or this Cookie Policy, please contact us:</p>
                <div class="contact-details">
                    <p><strong>Histone Solutions Private Limited</strong></p>
                    <p>Office 305 third floor Talha Heights 6th Road<br>
                    Rawalpindi, Punjab 46000, Pakistan</p>
                    <p>Email: <a href="mailto:info@histone.com.pk">info@histone.com.pk</a></p>
                    <p>Phone: <a href="tel:+923335508040">+92 333 5508040</a></p>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
