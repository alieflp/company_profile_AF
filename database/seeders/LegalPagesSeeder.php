<?php

namespace Database\Seeders;

use App\Models\LegalPage;
use Illuminate\Database\Seeder;

class LegalPagesSeeder extends Seeder
{
    public function run(): void
    {
        // Privacy Policy
        LegalPage::updateOrCreate(
            ['type' => 'privacy-policy'],
            [
                'title' => 'Privacy Policy',
                'content' => $this->getPrivacyPolicyContent(),
                'last_updated_at' => now(),
            ]
        );

        // Terms of Service
        LegalPage::updateOrCreate(
            ['type' => 'terms-of-service'],
            [
                'title' => 'Terms of Service',
                'content' => $this->getTermsOfServiceContent(),
                'last_updated_at' => now(),
            ]
        );
    }

    private function getPrivacyPolicyContent(): string
    {
        return <<<'EOT'
**Effective Date: December 3, 2025**

At AF Software Technology, we are committed to protecting your privacy and ensuring the security of your personal information. This Privacy Policy explains how we collect, use, and safeguard your data.

## 1. Information We Collect

We collect the following types of information:

### Personal Information
- Name
- Email address
- Phone number
- Company name
- Any other information you provide through our contact form

### Automatically Collected Information
- IP address
- Browser type and version
- Device information
- Pages visited and time spent on our website
- Cookies and similar tracking technologies

## 2. How We Use Your Information

We use your information for the following purposes:

- Responding to your inquiries and service requests
- Providing customer support
- Sending project updates and communications
- Improving our website and services
- Analyzing website usage and trends
- Complying with legal obligations

## 3. Data Sharing and Disclosure

We do not sell, trade, or rent your personal information to third parties. We may share your information only in the following circumstances:

- With your explicit consent
- To comply with legal obligations
- To protect our rights and property
- With service providers who assist us in operating our website (under strict confidentiality agreements)

## 4. Data Security

We implement industry-standard security measures to protect your personal information from unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the internet is 100% secure.

## 5. Cookies and Tracking Technologies

We use cookies to enhance your browsing experience. You can control cookie settings through your browser preferences. Disabling cookies may limit some website functionality.

## 6. Your Rights

Under Indonesian data protection law (UU PDP), you have the right to:

- Access your personal data
- Request correction of inaccurate data
- Request deletion of your data
- Withdraw consent for data processing
- Object to data processing

## 7. Third-Party Links

Our website may contain links to third-party websites. We are not responsible for the privacy practices of these external sites.

## 8. Children's Privacy

Our services are not directed to individuals under 18 years of age. We do not knowingly collect personal information from children.

## 9. Changes to This Policy

We may update this Privacy Policy from time to time. The latest version will always be posted on this page with the updated effective date.

## 10. Contact Us

If you have any questions about this Privacy Policy or wish to exercise your rights, please contact us:

- Email: info@afsoftwaretechnology.com
- Phone: +62 XXX XXXX XXXX
- Address: [Your Company Address]

**Last Updated: December 3, 2025**
EOT;
    }

    private function getTermsOfServiceContent(): string
    {
        return <<<'EOT'
**Effective Date: December 3, 2025**

Welcome to AF Software Technology. By accessing or using our services, you agree to be bound by these Terms of Service.

## 1. Acceptance of Terms

By using our website and services, you acknowledge that you have read, understood, and agree to be bound by these Terms of Service and our Privacy Policy.

## 2. Services Description

AF Software Technology provides:

- Custom software development
- Web application development
- Mobile application development
- IT consulting services
- System integration services
- Technical support and maintenance

## 3. User Obligations

You agree to:

- Provide accurate and complete information
- Maintain the confidentiality of any account credentials
- Use our services in compliance with applicable laws
- Not engage in any activity that could harm our website or services
- Not attempt to gain unauthorized access to our systems

## 4. Intellectual Property Rights

### Our Property
All content, designs, code, and materials on our website are owned by AF Software Technology and protected by Indonesian and international intellectual property laws.

### Client Projects
For custom development projects:
- Source code ownership will be defined in individual project contracts
- We retain the right to showcase completed projects in our portfolio (unless otherwise agreed)
- Client owns the final deliverables as specified in the contract

## 5. Project Terms

### Scope and Deliverables
- Project scope will be defined in a separate agreement or proposal
- Any changes to scope may affect timeline and pricing
- Deliverables will be provided as outlined in the project contract

### Payment Terms
- Payment terms will be specified in individual project contracts
- Typical structure: deposit, milestone payments, and final payment
- Late payments may result in project suspension

### Revisions
- Number of revisions will be specified in the project contract
- Additional revisions beyond the agreed scope may incur extra charges

## 6. Warranties and Disclaimers

### Limited Warranty
We warrant that our services will be performed in a professional and workmanlike manner.

### Disclaimer
OUR SERVICES ARE PROVIDED "AS IS" WITHOUT WARRANTIES OF ANY KIND, EITHER EXPRESS OR IMPLIED. WE DO NOT GUARANTEE THAT OUR SERVICES WILL BE UNINTERRUPTED OR ERROR-FREE.

## 7. Limitation of Liability

To the maximum extent permitted by Indonesian law, AF Software Technology shall not be liable for:

- Indirect, incidental, or consequential damages
- Loss of profits, data, or business opportunities
- Damages exceeding the amount paid for our services

## 8. Confidentiality

We will maintain the confidentiality of any proprietary information shared during the course of our engagement, subject to the terms of any Non-Disclosure Agreement (NDA).

## 9. Term and Termination

### Term
These Terms remain in effect while you use our services.

### Termination
Either party may terminate the agreement with written notice. Project-specific terms will be outlined in individual contracts.

## 10. Indemnification

You agree to indemnify and hold AF Software Technology harmless from any claims, damages, or expenses arising from your use of our services or violation of these Terms.

## 11. Dispute Resolution

### Governing Law
These Terms shall be governed by the laws of the Republic of Indonesia.

### Dispute Resolution Process
1. Good faith negotiations
2. Mediation (if negotiations fail)
3. Arbitration or legal proceedings in Indonesian courts

## 12. Force Majeure

We shall not be liable for any delay or failure to perform due to circumstances beyond our reasonable control, including natural disasters, war, or government actions.

## 13. Modifications to Terms

We reserve the right to modify these Terms at any time. Continued use of our services after changes constitutes acceptance of the modified Terms.

## 14. Severability

If any provision of these Terms is found to be unenforceable, the remaining provisions will remain in full force and effect.

## 15. Entire Agreement

These Terms, along with our Privacy Policy and any project-specific agreements, constitute the entire agreement between you and AF Software Technology.

## 16. Contact Information

For questions about these Terms of Service, please contact us:

- Email: info@afsoftwaretechnology.com
- Phone: +62 XXX XXXX XXXX
- Address: [Your Company Address]

**Last Updated: December 3, 2025**
EOT;
    }
}
