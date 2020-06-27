-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2020 at 12:29 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alignya_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `al_companies`
--

CREATE TABLE `al_companies` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `comp_licence` varchar(50) DEFAULT NULL COMMENT 'code',
  `slogan` varchar(255) DEFAULT NULL,
  `industry_id` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `company_currency` varchar(50) NOT NULL DEFAULT 'usd',
  `com_vision` text DEFAULT NULL,
  `com_values` text DEFAULT NULL,
  `com_mission` text DEFAULT NULL,
  `com_competitive_advantages` text DEFAULT NULL,
  `com_focus_area` text DEFAULT NULL,
  `comp_strategic_issue` text DEFAULT NULL,
  `support_email` varchar(255) DEFAULT NULL,
  `fiscal_start_month` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-jan, 12- desc month',
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `website` text DEFAULT NULL,
  `skype_id` varchar(255) DEFAULT NULL,
  `facebook` text DEFAULT NULL,
  `twitter` text DEFAULT NULL,
  `linkedin` text DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `is_removed` tinyint(4) DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `al_companies`
--

INSERT INTO `al_companies` (`id`, `company_name`, `comp_licence`, `slogan`, `industry_id`, `logo`, `company_currency`, `com_vision`, `com_values`, `com_mission`, `com_competitive_advantages`, `com_focus_area`, `comp_strategic_issue`, `support_email`, `fiscal_start_month`, `email`, `phone`, `mobile`, `fax`, `city`, `country`, `zip`, `address`, `website`, `skype_id`, `facebook`, `twitter`, `linkedin`, `plan_id`, `is_removed`, `created_at`, `updated_at`) VALUES
(1, 'Gisllp', NULL, 'Desc', NULL, NULL, 'usd', 'vision', 'values', 'mission', NULL, NULL, NULL, NULL, 1, 'gaurav.sadda@outlook.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2020-06-25 12:14:49', '2020-06-25 12:14:49');

-- --------------------------------------------------------

--
-- Table structure for table `al_comp_departments`
--

CREATE TABLE `al_comp_departments` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL COMMENT 'company id',
  `parent_department_id` int(11) DEFAULT 0 COMMENT '0- root, X - depart id',
  `department_name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0-inactive,1-active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='organization unit';

--
-- Dumping data for table `al_comp_departments`
--

INSERT INTO `al_comp_departments` (`id`, `company_id`, `parent_department_id`, `department_name`, `status`, `created_at`, `updated_at`) VALUES
(4, 1, NULL, 'cxxc', 1, '2020-06-27 07:34:39', '2020-06-27 07:34:39');

-- --------------------------------------------------------

--
-- Table structure for table `al_comp_plans`
--

CREATE TABLE `al_comp_plans` (
  `id` int(11) NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `sub_heading` text DEFAULT NULL,
  `emp_limit` int(11) NOT NULL,
  `summary` text DEFAULT NULL,
  `setup_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `training_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `plan_fee` decimal(10,2) DEFAULT NULL,
  `period` tinyint(4) NOT NULL COMMENT '1- Monthly, 2- Yearly',
  `plan_id` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0-inactive,1-active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `al_comp_plans`
--

INSERT INTO `al_comp_plans` (`id`, `heading`, `sub_heading`, `emp_limit`, `summary`, `setup_fee`, `training_fee`, `plan_fee`, `period`, `plan_id`, `status`) VALUES
(1, 'Basic Plan', 'Starting at $25 per month', 1, ' <li>\r\n                                                <p class=\"mb-0 \">\r\n                                                    30 Days Trial Period\r\n                                                </p>\r\n                                            </li>\r\n                                            <li>\r\n                                                <p class=\"mb-0 \">\r\n                                                    24/7 support\r\n                                                </p>\r\n                                            </li>\r\n                                            \r\n                                            <li>\r\n                                                <p class=\"mb-0 \">\r\n                                                    Free updates\r\n                                                </p>\r\n                                            </li>\r\n                                            <li>\r\n                                                <p class=\"mb-0 \">\r\n                                                    Forum support\r\n                                                </p>\r\n                                            </li>\r\n', '100.00', '1.00', '19.00', 1, 'price_1GxSOGC5M9h78utGKN6MQOqO', 1),
(2, 'Professional Plan', 'Starting at $80 per month.', 10, ' <li>\r\n                                                <p class=\"mb-0 \">\r\n                                                    30 Days Trial Period\r\n                                                </p>\r\n                                            </li>\r\n                                            <li>\r\n                                                <p class=\"mb-0 \">\r\n                                                    24/7 support\r\n                                                </p>\r\n                                            </li>\r\n                                            \r\n                                            <li>\r\n                                                <p class=\"mb-0 \">\r\n                                                    Two factor authentication\r\n                                                </p>\r\n                                            </li>\r\n                                            <li>\r\n                                                <p class=\"mb-0 \">\r\n                                                    Free updates\r\n                                                </p>\r\n                                            </li>\r\n                                            <li>\r\n                                                <p class=\"mb-0 \">\r\n                                                    Forum support\r\n                                                </p>\r\n                                            </li>', '0.00', '0.00', '25.00', 1, 'price_1GxSOGC5M9h78utGBG5gqlIB', 1),
(3, 'Enterprise Plan', 'Contact us for pricing details.', 25, '<li>\r\n                                                <p class=\"mb-0 \">\r\n                                                    30 Days Trial Period\r\n                                                </p>\r\n                                            </li>\r\n                                            <li>\r\n                                                <p class=\"mb-0 \">\r\n                                                    24/7 support\r\n                                                </p>\r\n                                            </li>\r\n                                            \r\n                                            <li>\r\n                                                <p class=\"mb-0 \">\r\n                                                    Two factor authentication\r\n                                                </p>\r\n                                            </li>\r\n                                            <li>\r\n                                                <p class=\"mb-0 \">\r\n                                                    Free updates\r\n                                                </p>\r\n                                            </li>\r\n                                            <li>\r\n                                                <p class=\"mb-0 \">\r\n                                                    Forum support\r\n                                                </p>\r\n                                            </li>', '0.00', '0.00', '50.00', 1, 'price_1GxSOGC5M9h78utGExjSFvwJ', 1),
(6, 'Enterprise Plan', 'Contact us for pricing details.', 25, 'Features and functionality for enterprises, agencies, and municipalities. Includes 25+ users, discounted update-only users, unlimited view-only users, and all Basic, Professional, and Enterprise features. Additional training and services are available.\r\n\r\n', '0.00', '0.00', '600.00', 2, NULL, 0),
(4, 'Basic Plan', 'Starting at $25 per month', 1, 'For smaller organizations or teams just getting started with strategy management. Includes 1 users and all Basic features. This plan requires a one-time additional on boarding fee of $100. Additional training and services are available.1', '0.00', '0.00', '228.00', 2, NULL, 0),
(5, 'Professional Plan', 'Starting at $80 per month.', 10, 'Features and functionality for medium sized organizations with several branch offices or divisions. Includes 10 users, and all Basic and Professional features. Additional training and services are available.', '0.00', '0.00', '300.00', 2, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `al_comp_scorecard`
--

CREATE TABLE `al_comp_scorecard` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL COMMENT '0- default, id - customization for company',
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0-inactive,1-active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='organization unit';

-- --------------------------------------------------------

--
-- Table structure for table `al_comp_subscriptions`
--

CREATE TABLE `al_comp_subscriptions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `emp_limit` int(11) NOT NULL DEFAULT 0,
  `heading` varchar(255) DEFAULT NULL,
  `setup_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `training_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `plan_fee` decimal(10,2) DEFAULT NULL,
  `total_stripe_payment` varchar(255) DEFAULT NULL,
  `period` tinyint(4) NOT NULL COMMENT '1- Monthly, 2- Yearly',
  `admin_notes` text DEFAULT NULL,
  `stripe_subscription_id` varchar(255) DEFAULT NULL,
  `stripe_plan_id` varchar(255) DEFAULT NULL COMMENT 'paid by paypal or stripe',
  `plan_id` int(11) DEFAULT NULL,
  `stripe_dump` text DEFAULT NULL COMMENT 'card, netbanking, wallet',
  `start_date` text DEFAULT NULL,
  `end_date` text DEFAULT NULL,
  `stripe_status` varchar(255) DEFAULT NULL COMMENT 'paid, failed, or error log',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `al_comp_subscriptions`
--

INSERT INTO `al_comp_subscriptions` (`id`, `user_id`, `company_id`, `emp_limit`, `heading`, `setup_fee`, `training_fee`, `plan_fee`, `total_stripe_payment`, `period`, `admin_notes`, `stripe_subscription_id`, `stripe_plan_id`, `plan_id`, `stripe_dump`, `start_date`, `end_date`, `stripe_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, NULL, '0.00', '0.00', '50.00', '50.00', 1, NULL, 'sub_HWxuK6nFbbuM2B', 'price_1GxSOGC5M9h78utGExjSFvwJ', 1, '{\"customer_id\":\"cus_HWxuQg6YoqrZST\",\"subscription\":{\"id\":\"sub_HWxuK6nFbbuM2B\",\"object\":\"subscription\",\"application_fee_percent\":null,\"billing\":\"charge_automatically\",\"billing_cycle_anchor\":1595679316,\"billing_thresholds\":null,\"cancel_at\":null,\"cancel_at_period_end\":false,\"canceled_at\":null,\"collection_method\":\"charge_automatically\",\"created\":1593087317,\"current_period_end\":1595679316,\"current_period_start\":1593087317,\"customer\":\"cus_HWxuQg6YoqrZST\",\"days_until_due\":null,\"default_payment_method\":null,\"default_source\":null,\"default_tax_rates\":[],\"discount\":null,\"ended_at\":null,\"invoice_customer_balance_settings\":{\"consume_applied_balance_on_void\":true},\"items\":{\"object\":\"list\",\"data\":[{\"id\":\"si_HWxuwVzYdMHKhv\",\"object\":\"subscription_item\",\"billing_thresholds\":null,\"created\":1593087318,\"metadata\":[],\"plan\":{\"id\":\"price_1GxSOGC5M9h78utGExjSFvwJ\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":5000,\"amount_decimal\":\"5000\",\"billing_scheme\":\"per_unit\",\"created\":1592981244,\"currency\":\"usd\",\"interval\":\"month\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HWVP4AzAM88dtb\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":30,\"usage_type\":\"licensed\"},\"price\":{\"id\":\"price_1GxSOGC5M9h78utGExjSFvwJ\",\"object\":\"price\",\"active\":true,\"billing_scheme\":\"per_unit\",\"created\":1592981244,\"currency\":\"usd\",\"livemode\":false,\"lookup_key\":null,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HWVP4AzAM88dtb\",\"recurring\":{\"aggregate_usage\":null,\"interval\":\"month\",\"interval_count\":1,\"trial_period_days\":30,\"usage_type\":\"licensed\"},\"tiers_mode\":null,\"transform_quantity\":null,\"type\":\"recurring\",\"unit_amount\":5000,\"unit_amount_decimal\":\"5000\"},\"quantity\":1,\"subscription\":\"sub_HWxuK6nFbbuM2B\",\"tax_rates\":[]}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/subscription_items?subscription=sub_HWxuK6nFbbuM2B\"},\"latest_invoice\":\"in_1Gxtz7C5M9h78utG72ewN38R\",\"livemode\":false,\"metadata\":[],\"next_pending_invoice_item_invoice\":null,\"pause_collection\":null,\"pending_invoice_item_interval\":null,\"pending_setup_intent\":null,\"pending_update\":null,\"plan\":{\"id\":\"price_1GxSOGC5M9h78utGExjSFvwJ\",\"object\":\"plan\",\"active\":true,\"aggregate_usage\":null,\"amount\":5000,\"amount_decimal\":\"5000\",\"billing_scheme\":\"per_unit\",\"created\":1592981244,\"currency\":\"usd\",\"interval\":\"month\",\"interval_count\":1,\"livemode\":false,\"metadata\":[],\"nickname\":null,\"product\":\"prod_HWVP4AzAM88dtb\",\"tiers\":null,\"tiers_mode\":null,\"transform_usage\":null,\"trial_period_days\":30,\"usage_type\":\"licensed\"},\"quantity\":1,\"schedule\":null,\"start\":1593087317,\"start_date\":1593087317,\"status\":\"trialing\",\"tax_percent\":null,\"transfer_data\":null,\"trial_end\":1595679316,\"trial_start\":1593087317}}', '1593087317', '1595679316', 'trialing', '2020-06-25 12:15:19', '2020-06-25 12:15:19');

-- --------------------------------------------------------

--
-- Table structure for table `al_comp_teams`
--

CREATE TABLE `al_comp_teams` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL COMMENT '0- default, id - customization for company',
  `department_id` int(11) DEFAULT NULL,
  `team_name` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `team_head` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0-inactive,1-active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='organization unit';

--
-- Dumping data for table `al_comp_teams`
--

INSERT INTO `al_comp_teams` (`id`, `company_id`, `department_id`, `team_name`, `size`, `team_head`, `status`, `created_at`, `updated_at`) VALUES
(9, 1, 4, 'team', 2, 2, 1, '2020-06-27 08:06:50', '2020-06-27 08:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `al_department_member`
--

CREATE TABLE `al_department_member` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `is_head` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1-head'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `al_department_member`
--

INSERT INTO `al_department_member` (`id`, `member_id`, `department_id`, `is_head`) VALUES
(1, 4, 4, 0),
(2, 5, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `al_email_templates`
--

CREATE TABLE `al_email_templates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_group` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Hide from user | unique and fetch by this key',
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `template_body` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `al_email_templates`
--

INSERT INTO `al_email_templates` (`id`, `name`, `email_group`, `subject`, `template_body`, `created_at`, `updated_at`) VALUES
(1, 'registration ', 'registration', 'Registration successful', '{Name}', NULL, NULL),
(2, NULL, 'forgot_password', 'Forgot Password', '', NULL, NULL),
(3, NULL, 'change_email', 'Change Email', '', NULL, NULL),
(4, NULL, 'activate_account', 'Activate Account', '', NULL, NULL),
(5, NULL, 'reset_password', 'Reset Password', '', NULL, NULL),
(6, NULL, 'bug_assigned', 'New Bug Assigned', '', NULL, NULL),
(7, NULL, 'bug_updated', 'Bug status changed', '', NULL, NULL),
(8, NULL, 'bug_comments', 'New Bug Comment Received', '', NULL, NULL),
(9, NULL, 'bug_attachment', 'New bug attachment', '', NULL, NULL),
(10, NULL, 'bug_reported', 'New bug Reported', '', NULL, NULL),
(13, NULL, 'refund_confirmation', 'Refund Confirmation', '', NULL, NULL),
(14, NULL, 'payment_confirmation', 'Payment Confirmation', '', NULL, NULL),
(15, NULL, 'payment_email', 'Payment Received', '', NULL, NULL),
(16, NULL, 'invoice_overdue_email', 'Invoice Overdue Notice', '', NULL, NULL),
(17, NULL, 'invoice_message', 'New Invoice', '', NULL, NULL),
(18, NULL, 'invoice_reminder', 'Invoice Reminder', '', NULL, NULL),
(19, NULL, 'message_received', 'Message Received', '', NULL, NULL),
(20, NULL, 'estimate_email', 'New Estimate', '', NULL, NULL),
(21, NULL, 'ticket_staff_email', 'New Ticket [TICKET_CODE]', '', NULL, NULL),
(22, NULL, 'ticket_client_email', 'Ticket [TICKET_CODE] Opened', '', NULL, NULL),
(23, NULL, 'ticket_reply_email', 'Ticket [TICKET_CODE] Response', '', NULL, NULL),
(24, NULL, 'ticket_closed_email', 'Ticket [TICKET_CODE] Closed', '', NULL, NULL),
(26, NULL, 'task_updated', 'Task updated', '', NULL, NULL),
(27, NULL, 'quotations_form', 'Your Quotation Request', '', NULL, NULL),
(28, NULL, 'client_notification', 'New project created', '', NULL, NULL),
(29, NULL, 'assigned_project', 'Assigned Project', '', NULL, NULL),
(30, NULL, 'complete_projects', 'Project Completed', '', NULL, NULL),
(31, NULL, 'project_comments', 'New Project Comment Received', '', NULL, NULL),
(32, NULL, 'project_attachment', 'New Project  Attachment', '', NULL, NULL),
(33, NULL, 'responsible_milestone', 'Responsible for a Milestone', '', NULL, NULL),
(34, NULL, 'task_assigned', 'Task assigned', '', NULL, NULL),
(35, NULL, 'tasks_comments', 'New Task Comment Received', '', NULL, NULL),
(36, NULL, 'tasks_attachment', 'New Tasks Attachment', '', NULL, NULL),
(37, NULL, 'tasks_updated', 'Task updated', '', NULL, NULL),
(38, NULL, 'goal_not_achieve', 'Not Achieve Goal', '', NULL, NULL),
(39, NULL, 'goal_achieve', 'Achieve Goal', '', NULL, NULL),
(40, NULL, 'leave_request_email', 'A Leave Request from you', '', NULL, NULL),
(41, NULL, 'leave_approve_email', 'Your leave request has been approved', '', NULL, NULL),
(42, NULL, 'leave_reject_email', 'Your leave request has been Rejected', '', NULL, NULL),
(43, NULL, 'overtime_request_email', 'Overtime Request', '', NULL, NULL),
(44, NULL, 'overtime_approved_email', 'Your overtime request has been approved', '', NULL, NULL),
(45, NULL, 'overtime_reject_email', 'Your Overtime request has been Rejected', '', NULL, NULL),
(46, NULL, 'wellcome_email', 'Welcome Email ', '', NULL, NULL),
(47, NULL, 'payslip_generated_email', 'Payslip generated', '', NULL, NULL),
(48, NULL, 'advance_salary_email', 'Advance Salary Reqeust', '', NULL, NULL),
(49, NULL, 'advance_salary_approve_email', 'Your advance salary request has been approved', '', NULL, NULL),
(50, NULL, 'advance_salary_reject_email', 'Your advance salary request has been Rejected', '', NULL, NULL),
(51, NULL, 'award_email', 'Award Received', '', NULL, NULL),
(52, NULL, 'new_job_application_email', 'New job application submitted', '', NULL, NULL),
(53, NULL, 'new_notice_published', 'New Notice published', '', NULL, NULL),
(54, NULL, 'new_training_email', 'Training  Assigned ', '', NULL, NULL),
(55, NULL, 'performance_appraisal_email', 'New Performance Appraisal', '', NULL, NULL),
(56, NULL, 'expense_request_email', 'A New Expense Request have been Recieved', '', NULL, NULL),
(57, NULL, 'expense_approved_email', 'Expense Approved', '', NULL, NULL),
(58, NULL, 'expense_paid_email', 'Expense have been Paid', '', NULL, NULL),
(59, NULL, 'auto_close_ticket', 'Ticket Auto Closed', '', NULL, NULL),
(60, NULL, 'proposal_email', 'New Proposal', '', NULL, NULL),
(61, NULL, 'project_overdue_email', 'Project Overdue Notice', '', NULL, NULL),
(62, NULL, 'estimate_overdue_email', 'Estimate Overdue Notice', '', NULL, NULL),
(63, NULL, 'proposal_overdue_email', 'New Estimate', '', NULL, NULL),
(64, NULL, 'call_for_interview', 'You have an interview offer!!!', '', NULL, NULL),
(65, NULL, 'token_activate_account', 'Activate Account', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `al_goal_cycles`
--

CREATE TABLE `al_goal_cycles` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `cycle_name` varchar(255) DEFAULT NULL,
  `no_months` int(11) NOT NULL COMMENT 'no of months',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0-inactive,1-active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `al_goal_cycles`
--

INSERT INTO `al_goal_cycles` (`id`, `company_id`, `cycle_name`, `no_months`, `status`) VALUES
(1, 0, 'Vision Cycle for 10 Years', 10, 1),
(2, 0, 'Vision Cycle for 5 Years', 5, 1),
(3, 0, '2020, 2021 and 2022 (3 Years)', 3, 1),
(4, 0, 'Fiscal Year 2020', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `al_ideas`
--

CREATE TABLE `al_ideas` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL COMMENT 'admin notes',
  `is_popular` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1- yes, 0- no',
  `status` tinyint(4) NOT NULL COMMENT '1- Waiting for approval, 2-Open, 3-Close, 4-Promoted to Goal, 5- Planned, 6- Already exist, 7- Not Useful',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `al_idea_attachments`
--

CREATE TABLE `al_idea_attachments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `idea_id` int(11) NOT NULL,
  `idea_file` varchar(250) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `al_idea_comments`
--

CREATE TABLE `al_idea_comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `idea_id` int(11) NOT NULL,
  `comments` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `al_idea_likes`
--

CREATE TABLE `al_idea_likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `idea_id` int(11) NOT NULL,
  `idea_comment_id` int(11) DEFAULT NULL,
  `is_like` tinyint(4) DEFAULT NULL COMMENT '0- dislike, 1- like',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `al_idea_topics`
--

CREATE TABLE `al_idea_topics` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0-inactive,1-active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Goal/Measure/Initiative status';

-- --------------------------------------------------------

--
-- Table structure for table `al_master_industries`
--

CREATE TABLE `al_master_industries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0-inactive,1-active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='organization unit';

--
-- Dumping data for table `al_master_industries`
--

INSERT INTO `al_master_industries` (`id`, `name`, `status`) VALUES
(1, 'Graphic Designing', 1),
(9, 'Software Development', 0),
(8, 'Mechnical', 1),
(5, 'Medical', 1),
(7, 'Online Store', 1);

-- --------------------------------------------------------

--
-- Table structure for table `al_master_status`
--

CREATE TABLE `al_master_status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `bg_color` varchar(50) DEFAULT NULL,
  `icons` varchar(100) DEFAULT NULL,
  `is_obj` tinyint(4) NOT NULL DEFAULT 1,
  `is_meas` tinyint(4) NOT NULL DEFAULT 1,
  `is_mil` tinyint(4) NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0-inactive,1-active',
  `is_task` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Goal/Measure/Initiative status';

--
-- Dumping data for table `al_master_status`
--

INSERT INTO `al_master_status` (`id`, `name`, `bg_color`, `icons`, `is_obj`, `is_meas`, `is_mil`, `status`, `is_task`) VALUES
(2, 'In Progress', '#1fb1d1', '1589911577743.png', 0, 0, 0, 1, 1),
(3, 'On Hold', '#f73f23', '1589911791471.png', 0, 0, 0, 1, 1),
(4, 'Above Target', '#0bba45', '1584161903803.png', 0, 0, 0, 1, 0),
(5, 'Completed', '#0ff267', '1589912162365.png', 0, 0, 0, 1, 1),
(6, 'Overdue', '#ff9a0a', '1589912334331.png', 0, 0, 0, 1, 0),
(7, 'Failed', '#df4190', '1589912453705.png', 0, 0, 0, 1, 1),
(8, 'Below Plan', '#f44336', '1589912740671.png', 0, 0, 0, 1, 0),
(9, 'No Information', '#c4c2c2', '1589912966398.png', 0, 0, 0, 1, 0),
(1, 'Not Started', '#4dd0e1', '1589913090438.png', 0, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `al_measures`
--

CREATE TABLE `al_measures` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1- measure, 2- Initiative, 3- KPI',
  `company_id` int(11) DEFAULT NULL,
  `objective_id` int(11) DEFAULT NULL,
  `measure_type` text DEFAULT NULL COMMENT '[Binar/Value/Currcy/percentage/Revenue]',
  `measure_unit` varchar(100) DEFAULT NULL COMMENT 'ex. usd,uro, fit, sq meter etc',
  `heading` tinytext DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `measure_team_type` enum('department','team','individual') NOT NULL,
  `measure_department_id` int(11) DEFAULT NULL,
  `measure_team_id` int(11) DEFAULT NULL,
  `owner_user_id` int(11) DEFAULT NULL COMMENT 'HOD or Team leader',
  `measure_actual` decimal(10,2) DEFAULT NULL,
  `measure_target` decimal(10,2) DEFAULT NULL,
  `measure_target_new` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Projection line draw always with this data',
  `measure_graph_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 - Simple Mixing Bar, 2-Line Graph, 3- Compossed Line Bar & Area Char ',
  `calculation_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0-fixed, 1- incremental',
  `target_color` varchar(50) DEFAULT NULL,
  `actual_color` varchar(50) DEFAULT NULL,
  `projection_color` varchar(50) DEFAULT NULL,
  `kpi_quaters` varchar(255) DEFAULT NULL COMMENT '2020-Q1,2021-Q2,2021-Q3',
  `kpi_quater_month` varchar(255) DEFAULT NULL COMMENT 'Y-m-1, Y-m-1',
  `measure_cycle_year` int(11) DEFAULT NULL COMMENT 'ex 2020',
  `measure_cycle_quarter` tinyint(4) DEFAULT NULL COMMENT 'ex 1 or 2 or 3 or 4 = Q1, Q2',
  `quarter_start_month` tinyint(4) DEFAULT NULL COMMENT '4 - April , May and June',
  `check_in_frequency` tinyint(4) DEFAULT NULL COMMENT '1- daily, 2- weekly,  3- monthly,4-Quarter',
  `confidence_level` varchar(100) DEFAULT NULL COMMENT 'At Risk, No Issues, Ahead of Plan',
  `is_save_publish` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-save as draft, 2- save as publish, 3- unpublished',
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `al_milestones_revenues`
--

CREATE TABLE `al_milestones_revenues` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `milestone_id` int(11) DEFAULT NULL,
  `target_gm` decimal(10,2) NOT NULL DEFAULT 0.00,
  `target_mm` decimal(10,2) NOT NULL DEFAULT 0.00,
  `target_nm` decimal(10,2) NOT NULL DEFAULT 0.00,
  `target_expense` decimal(10,2) NOT NULL DEFAULT 0.00,
  `target_net` decimal(10,2) NOT NULL DEFAULT 0.00,
  `target_ebitda` decimal(10,2) NOT NULL DEFAULT 0.00,
  `actual_gm` decimal(10,2) NOT NULL DEFAULT 0.00,
  `actual_mm` decimal(10,2) NOT NULL DEFAULT 0.00,
  `actual_nm` decimal(10,2) NOT NULL DEFAULT 0.00,
  `actual_expense` decimal(10,2) NOT NULL DEFAULT 0.00,
  `actual_net` decimal(10,2) NOT NULL DEFAULT 0.00,
  `actual_ebitda` decimal(10,2) NOT NULL DEFAULT 0.00,
  `projection_gm` decimal(10,2) NOT NULL DEFAULT 0.00,
  `projection_mm` decimal(10,2) NOT NULL DEFAULT 0.00,
  `projection_nm` decimal(10,2) NOT NULL DEFAULT 0.00,
  `projection_expense` decimal(10,2) NOT NULL DEFAULT 0.00,
  `projection_net` decimal(10,2) NOT NULL DEFAULT 0.00,
  `projection_ebitda` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `al_notifications`
--

CREATE TABLE `al_notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `notify_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1-welcome 2-password change 3-assigned 4-status changed',
  `notify_msg` tinytext DEFAULT NULL,
  `notify_url` tinytext DEFAULT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0-no, 1- yes',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='tasks and milestones';

-- --------------------------------------------------------

--
-- Table structure for table `al_objectives`
--

CREATE TABLE `al_objectives` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `is_home` tinyint(4) NOT NULL DEFAULT 0,
  `objective_id` int(11) DEFAULT NULL,
  `cycle_id` int(11) DEFAULT NULL,
  `team_type` enum('department','team','individual') NOT NULL DEFAULT 'individual',
  `department_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `owner_user_id` int(11) DEFAULT NULL,
  `perspective_id` varchar(255) DEFAULT NULL,
  `scorecard_id` varchar(50) DEFAULT NULL,
  `theme_id` int(11) DEFAULT NULL COMMENT 'sink with theme_items table',
  `heading` tinytext DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `goal_visibility` enum('public','private','restricted') NOT NULL DEFAULT 'public',
  `confidence_level` varchar(100) NOT NULL DEFAULT '' COMMENT 'At Risk, No Issues, Ahead of Plan',
  `is_save_publish` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-save as draft, 2- save as publish, 3- unpublished',
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `al_perspectives`
--

CREATE TABLE `al_perspectives` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0-inactive,1-active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Strategic Map';

--
-- Dumping data for table `al_perspectives`
--

INSERT INTO `al_perspectives` (`id`, `name`, `status`) VALUES
(1, 'Financial', 1),
(2, 'Customer', 1),
(3, 'Process/Tools', 1),
(4, 'People', 1);

-- --------------------------------------------------------

--
-- Table structure for table `al_project_analysis`
--

CREATE TABLE `al_project_analysis` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL COMMENT '1- obj, 2- sub obj, 3-measure, 4- sub-measure, 5- initiative, 6 - tasks,',
  `analysis` text DEFAULT NULL,
  `percent_complete` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='work status';

-- --------------------------------------------------------

--
-- Table structure for table `al_project_attachments`
--

CREATE TABLE `al_project_attachments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `attach_type` tinyint(4) DEFAULT NULL COMMENT '1- obj, 2- sub obj, 3-measure, 4- sub-measure, 5- initiative, 6 - tasks,',
  `project_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `al_project_comments`
--

CREATE TABLE `al_project_comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `comments` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `al_supports`
--

CREATE TABLE `al_supports` (
  `id` int(11) NOT NULL,
  `ticket_no` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'random unique no 6 digit',
  `company_id` int(11) DEFAULT NULL,
  `postedby_id` int(11) DEFAULT NULL,
  `ticket_subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Technical Issue, Functional Issue, Bugs in System, Suggestions, Other',
  `ticket_message` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `ticket_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0- Open, 1 - closed, 2 - On hold, 3- Declined',
  `priority_id` enum('high','normal','low') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'normal',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `al_supports_replies`
--

CREATE TABLE `al_supports_replies` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `support_id` int(11) NOT NULL,
  `ticket_reply` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `al_tasks`
--

CREATE TABLE `al_tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `objective_id` int(11) DEFAULT NULL COMMENT 'always add',
  `measure_id` int(11) DEFAULT NULL COMMENT 'measure_id/initative_id/KAPI_id',
  `type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1- Measure, 2- Initiative, 3- KPI, 0- objective, ',
  `task_name` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT 'Not Started, In Progress, Completed, Failed, Hold',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='tasks and milestones';

-- --------------------------------------------------------

--
-- Table structure for table `al_task_replies`
--

CREATE TABLE `al_task_replies` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `task_reply` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='tasks and milestones';

-- --------------------------------------------------------

--
-- Table structure for table `al_teams_members`
--

CREATE TABLE `al_teams_members` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `is_head` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1-head'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `al_teams_members`
--

INSERT INTO `al_teams_members` (`id`, `member_id`, `team_id`, `is_head`) VALUES
(1, 2, 1, 1),
(2, 2, 2, 1),
(3, 2, 3, 1),
(4, 2, 8, 1),
(5, 4, 9, 0),
(6, 2, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `al_theme`
--

CREATE TABLE `al_theme` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `theme_name` varchar(255) NOT NULL,
  `theme_summary` text DEFAULT NULL,
  `fiscal_year` year(4) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `status`) VALUES
(1, 'Andorra', 'AD', 1),
(2, 'United Arab Emirates', 'AE', 1),
(3, 'Afghanistan', 'AF', 1),
(4, 'Antigua and Barbuda', 'AG', 1),
(5, 'Anguilla', 'AI', 1),
(6, 'Albania', 'AL', 1),
(7, 'Armenia', 'AM', 1),
(8, 'Netherlands Antilles', 'AN', 1),
(9, 'Angola', 'AO', 1),
(10, 'Asia/Pacific Region', 'AP', 1),
(11, 'Antarctica', 'AQ', 1),
(12, 'Argentina', 'AR', 1),
(13, 'American Samoa', 'AS', 1),
(14, 'Austria', 'AT', 1),
(15, 'Australia', 'AU', 1),
(16, 'Aruba', 'AW', 1),
(17, 'Aland Islands', 'AX', 1),
(18, 'Azerbaijan', 'AZ', 1),
(19, 'Bosnia and Herzegovina', 'BA', 1),
(20, 'Barbados', 'BB', 1),
(21, 'Bangladesh', 'BD', 1),
(22, 'Belgium', 'BE', 1),
(23, 'Burkina Faso', 'BF', 1),
(24, 'Bulgaria', 'BG', 1),
(25, 'Bahrain', 'BH', 1),
(26, 'Burundi', 'BI', 1),
(27, 'Benin', 'BJ', 1),
(28, 'Saint Bartelemey', 'BL', 1),
(29, 'Bermuda', 'BM', 1),
(30, 'Brunei Darussalam', 'BN', 1),
(31, 'Bolivia', 'BO', 1),
(32, 'Brazil', 'BR', 1),
(33, 'Bahamas', 'BS', 1),
(34, 'Bhutan', 'BT', 1),
(35, 'Bouvet Island', 'BV', 1),
(36, 'Botswana', 'BW', 1),
(37, 'Belarus', 'BY', 1),
(38, 'Belize', 'BZ', 1),
(39, 'Canada', 'CA', 1),
(40, 'Cocos (Keeling) Islands', 'CC', 1),
(41, 'Congo, The Democratic Republic of the', 'CD', 1),
(42, 'Central African Republic', 'CF', 1),
(43, 'Congo', 'CG', 1),
(44, 'Switzerland', 'CH', 1),
(45, 'Cote d\'Ivoire', 'CI', 1),
(46, 'Cook Islands', 'CK', 1),
(47, 'Chile', 'CL', 1),
(48, 'Cameroon', 'CM', 1),
(49, 'China', 'CN', 1),
(50, 'Colombia', 'CO', 1),
(51, 'Costa Rica', 'CR', 1),
(52, 'Cuba', 'CU', 1),
(53, 'Cape Verde', 'CV', 1),
(54, 'Christmas Island', 'CX', 1),
(55, 'Cyprus', 'CY', 1),
(56, 'Czech Republic', 'CZ', 1),
(57, 'Germany', 'DE', 1),
(58, 'Djibouti', 'DJ', 1),
(59, 'Denmark', 'DK', 1),
(60, 'Dominica', 'DM', 1),
(61, 'Dominican Republic', 'DO', 1),
(62, 'Algeria', 'DZ', 1),
(63, 'Ecuador', 'EC', 1),
(64, 'Estonia', 'EE', 1),
(65, 'Egypt', 'EG', 1),
(66, 'Western Sahara', 'EH', 1),
(67, 'Eritrea', 'ER', 1),
(68, 'Spain', 'ES', 1),
(69, 'Ethiopia', 'ET', 1),
(70, 'Europe', 'EU', 1),
(71, 'Finland', 'FI', 1),
(72, 'Fiji', 'FJ', 1),
(73, 'Falkland Islands (Malvinas)', 'FK', 1),
(74, 'Micronesia, Federated States of', 'FM', 1),
(75, 'Faroe Islands', 'FO', 1),
(76, 'France', 'FR', 1),
(77, 'France, Metropolitan', 'FX', 1),
(78, 'Gabon', 'GA', 1),
(79, 'United Kingdom', 'GB', 1),
(80, 'Grenada', 'GD', 1),
(81, 'Georgia', 'GE', 1),
(82, 'French Guiana', 'GF', 1),
(83, 'Guernsey', 'GG', 1),
(84, 'Ghana', 'GH', 1),
(85, 'Gibraltar', 'GI', 1),
(86, 'Greenland', 'GL', 1),
(87, 'Gambia', 'GM', 1),
(88, 'Guinea', 'GN', 1),
(89, 'Guadeloupe', 'GP', 1),
(90, 'Equatorial Guinea', 'GQ', 1),
(91, 'Greece', 'GR', 1),
(92, 'South Georgia and the South Sandwich Islands', 'GS', 1),
(93, 'Guatemala', 'GT', 1),
(94, 'Guam', 'GU', 1),
(95, 'Guinea-Bissau', 'GW', 1),
(96, 'Guyana', 'GY', 1),
(97, 'Hong Kong', 'HK', 1),
(98, 'Heard Island and McDonald Islands', 'HM', 1),
(99, 'Honduras', 'HN', 1),
(100, 'Croatia', 'HR', 1),
(101, 'Haiti', 'HT', 1),
(102, 'Hungary', 'HU', 1),
(103, 'Indonesia', 'ID', 1),
(104, 'Ireland', 'IE', 1),
(105, 'Israel', 'IL', 1),
(106, 'Isle of Man', 'IM', 1),
(107, 'India', 'IN', 1),
(108, 'British Indian Ocean Territory', 'IO', 1),
(109, 'Iraq', 'IQ', 1),
(110, 'Iran, Islamic Republic of', 'IR', 1),
(111, 'Iceland', 'IS', 1),
(112, 'Italy', 'IT', 1),
(113, 'Jersey', 'JE', 1),
(114, 'Jamaica', 'JM', 1),
(115, 'Jordan', 'JO', 1),
(116, 'Japan', 'JP', 1),
(117, 'Kenya', 'KE', 1),
(118, 'Kyrgyzstan', 'KG', 1),
(119, 'Cambodia', 'KH', 1),
(120, 'Kiribati', 'KI', 1),
(121, 'Comoros', 'KM', 1),
(122, 'Saint Kitts and Nevis', 'KN', 1),
(123, 'Korea, Democratic People\'s Republic of', 'KP', 1),
(124, 'Korea, Republic of', 'KR', 1),
(125, 'Kuwait', 'KW', 1),
(126, 'Cayman Islands', 'KY', 1),
(127, 'Kazakhstan', 'KZ', 1),
(128, 'Lao People\'s Democratic Republic', 'LA', 1),
(129, 'Lebanon', 'LB', 1),
(130, 'Saint Lucia', 'LC', 1),
(131, 'Liechtenstein', 'LI', 1),
(132, 'Sri Lanka', 'LK', 1),
(133, 'Liberia', 'LR', 1),
(134, 'Lesotho', 'LS', 1),
(135, 'Lithuania', 'LT', 1),
(136, 'Luxembourg', 'LU', 1),
(137, 'Latvia', 'LV', 1),
(138, 'Libyan Arab Jamahiriya', 'LY', 1),
(139, 'Morocco', 'MA', 1),
(140, 'Monaco', 'MC', 1),
(141, 'Moldova, Republic of', 'MD', 1),
(142, 'Montenegro', 'ME', 1),
(143, 'Saint Martin', 'MF', 1),
(144, 'Madagascar', 'MG', 1),
(145, 'Marshall Islands', 'MH', 1),
(146, 'Macedonia', 'MK', 1),
(147, 'Mali', 'ML', 1),
(148, 'Myanmar', 'MM', 1),
(149, 'Mongolia', 'MN', 1),
(150, 'Macao', 'MO', 1),
(151, 'Northern Mariana Islands', 'MP', 1),
(152, 'Martinique', 'MQ', 1),
(153, 'Mauritania', 'MR', 1),
(154, 'Montserrat', 'MS', 1),
(155, 'Malta', 'MT', 1),
(156, 'Mauritius', 'MU', 1),
(157, 'Maldives', 'MV', 1),
(158, 'Malawi', 'MW', 1),
(159, 'Mexico', 'MX', 1),
(160, 'Malaysia', 'MY', 1),
(161, 'Mozambique', 'MZ', 1),
(162, 'Namibia', 'NA', 1),
(163, 'New Caledonia', 'NC', 1),
(164, 'Niger', 'NE', 1),
(165, 'Norfolk Island', 'NF', 1),
(166, 'Nigeria', 'NG', 1),
(167, 'Nicaragua', 'NI', 1),
(168, 'Netherlands', 'NL', 1),
(169, 'Norway', 'NO', 1),
(170, 'Nepal', 'NP', 1),
(171, 'Nauru', 'NR', 1),
(172, 'Niue', 'NU', 1),
(173, 'New Zealand', 'NZ', 1),
(174, 'Oman', 'OM', 1),
(175, 'Panama', 'PA', 1),
(176, 'Peru', 'PE', 1),
(177, 'French Polynesia', 'PF', 1),
(178, 'Papua New Guinea', 'PG', 1),
(179, 'Philippines', 'PH', 1),
(180, 'Pakistan', 'PK', 1),
(181, 'Poland', 'PL', 1),
(182, 'Saint Pierre and Miquelon', 'PM', 1),
(183, 'Pitcairn', 'PN', 1),
(184, 'Puerto Rico', 'PR', 1),
(185, 'Palestinian Territory', 'PS', 1),
(186, 'Portugal', 'PT', 1),
(187, 'Palau', 'PW', 1),
(188, 'Paraguay', 'PY', 1),
(189, 'Qatar', 'QA', 1),
(190, 'Reunion', 'RE', 1),
(191, 'Romania', 'RO', 1),
(192, 'Serbia', 'RS', 1),
(193, 'Russian Federation', 'RU', 1),
(194, 'Rwanda', 'RW', 1),
(195, 'Saudi Arabia', 'SA', 1),
(196, 'Solomon Islands', 'SB', 1),
(197, 'Seychelles', 'SC', 1),
(198, 'Sudan', 'SD', 1),
(199, 'Sweden', 'SE', 1),
(200, 'Singapore', 'SG', 1),
(201, 'Saint Helena', 'SH', 1),
(202, 'Slovenia', 'SI', 1),
(203, 'Svalbard and Jan Mayen', 'SJ', 1),
(204, 'Slovakia', 'SK', 1),
(205, 'Sierra Leone', 'SL', 1),
(206, 'San Marino', 'SM', 1),
(207, 'Senegal', 'SN', 1),
(208, 'Somalia', 'SO', 1),
(209, 'Suriname', 'SR', 1),
(210, 'Sao Tome and Principe', 'ST', 1),
(211, 'El Salvador', 'SV', 1),
(212, 'Syrian Arab Republic', 'SY', 1),
(213, 'Swaziland', 'SZ', 1),
(214, 'Turks and Caicos Islands', 'TC', 1),
(215, 'Chad', 'TD', 1),
(216, 'French Southern Territories', 'TF', 1),
(217, 'Togo', 'TG', 1),
(218, 'Thailand', 'TH', 1),
(219, 'Tajikistan', 'TJ', 1),
(220, 'Tokelau', 'TK', 1),
(221, 'Timor-Leste', 'TL', 1),
(222, 'Turkmenistan', 'TM', 1),
(223, 'Tunisia', 'TN', 1),
(224, 'Tonga', 'TO', 1),
(225, 'Turkey', 'TR', 1),
(226, 'Trinidad and Tobago', 'TT', 1),
(227, 'Tuvalu', 'TV', 1),
(228, 'Taiwan', 'TW', 1),
(229, 'Tanzania, United Republic of', 'TZ', 1),
(230, 'Ukraine', 'UA', 1),
(231, 'Uganda', 'UG', 1),
(232, 'United States Minor Outlying Islands', 'UM', 1),
(233, 'United States', 'US', 1),
(234, 'Uruguay', 'UY', 1),
(235, 'Uzbekistan', 'UZ', 1),
(236, 'Holy See (Vatican City State)', 'VA', 1),
(237, 'Saint Vincent and the Grenadines', 'VC', 1),
(238, 'Venezuela', 'VE', 1),
(239, 'Virgin Islands, British', 'VG', 1),
(240, 'Virgin Islands, U.S.', 'VI', 1),
(241, 'Vietnam', 'VN', 1),
(242, 'Vanuatu', 'VU', 1),
(243, 'Wallis and Futuna', 'WF', 1),
(244, 'Samoa', 'WS', 1),
(245, 'Yemen', 'YE', 1),
(246, 'Mayotte', 'YT', 1),
(247, 'South Africa', 'ZA', 1),
(248, 'Zambia', 'ZM', 1),
(249, 'Zimbabwe', 'ZW', 1);

-- --------------------------------------------------------

--
-- Table structure for table `labels`
--

CREATE TABLE `labels` (
  `id` int(11) NOT NULL,
  `label_key` text NOT NULL,
  `label_text_en` text DEFAULT NULL,
  `label_text_fr` text DEFAULT NULL,
  `label_text_sp` text DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=inactive, 1=active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', '5e5a0a72176d2_Grossbritanien.png', 1, '2020-02-29 06:53:38', '2020-02-29 06:53:38'),
(2, 'Spanish', 'sp', '5eb5add2349f3_spain-flag-icon-free-download.jpg', 0, '2020-05-06 21:00:21', '2020-05-15 13:11:21'),
(3, 'French', 'fr', '5eb5ade82c6c2_france-flag-icon-free-download.jpg', 0, '2020-05-06 21:00:50', '2020-05-15 13:11:13');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `label` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `label`, `slug`, `value`, `type`, `description`) VALUES
(1, 'Site Name', 'site_name', 'Steamer Studio', 'text', 'Website name will be used in site emails, from name etc'),
(2, 'Admin Email', 'admin_email', 'dev.girishas@gmail.com', 'text', 'Website primary email used by emails as from address'),
(4, 'Linked Profile', 'linkedin_api_id', 'http://in.linkedin.com/pub/girishas-info-solution/59/793/a60', 'text', 'Linked in URL with http'),
(5, 'Google Plus', 'gplus', 'https://plus.google.com/107308183860141472439/posts', 'text', 'Google plus url with http'),
(6, 'Facebook', 'facebook', 'https://www.facebook.com/GirishasITSolutions', 'text', 'Facebook url with http'),
(7, 'Twitter', 'twitter', 'https://twitter.com/GirishasInfo', 'text', 'Twitter url with http'),
(10, 'Payout Minimum', 'payout_minimum', '80', 'text', 'Minimum amount required to payout'),
(11, 'Payout Days', 'payout_days', '0', 'text', 'Days after which payout can be made ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` tinyint(4) DEFAULT NULL COMMENT '1-admin,2-Company owner, 3-HOD, 4-team lead, 5-member',
  `emp_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_you` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language_id` int(11) DEFAULT 1,
  `photo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-male, 2-female',
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_1` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_2` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `mobile` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enable_subscription` tinyint(4) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `varify_hash` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `varify_account` tinyint(4) DEFAULT 0,
  `facebook_id` bigint(20) DEFAULT NULL,
  `skype_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_csv` tinyint(4) NOT NULL DEFAULT 0,
  `trial_expiry_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_membership_plan` int(11) DEFAULT NULL,
  `token_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lost_password_code` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_activation_code` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_customer_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_activity` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=inactive | 1=active | 2=Blocked',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `emp_code`, `company_id`, `email`, `first_name`, `last_name`, `full_name`, `designation`, `password`, `about_you`, `language_id`, `photo`, `gender`, `dob`, `street_1`, `street_2`, `address`, `state`, `province`, `city`, `zip`, `country_id`, `mobile`, `website`, `enable_subscription`, `remember_token`, `varify_hash`, `varify_account`, `facebook_id`, `skype_id`, `linkedin_id`, `twitter_id`, `is_csv`, `trial_expiry_date`, `current_membership_plan`, `token_code`, `lost_password_code`, `email_activation_code`, `stripe_customer_id`, `last_activity`, `user_ip`, `user_agent`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'EMP-1-1', 1, 'gaurav.sadda@outlook.com', 'Gaurav', 'Jain', 'Gaurav Jain', NULL, '$2y$10$07AGwb/QmcsCdr.SfL.ps.ZWUPT61nr2jj6mCs6B9gpSEQLlP1uhK', NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '123456', NULL, 0, 'vxsv2sMHOlOoLyECic4ucLQC8ruKIzYaDpnJbLa0IWHiyZKDp4PVcsuvTmXx', NULL, 0, NULL, NULL, NULL, NULL, 0, '1595679316', 1, NULL, NULL, NULL, 'cus_HWxuQg6YoqrZST', '2020-06-25 12:15:19', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.116 Safari/537.36', 1, '2020-06-25 12:15:19', '2020-06-26 13:02:19'),
(2, 4, NULL, 1, 'new@user.com', 'first', 'user', NULL, 'dfdsf', '$2y$10$1fGqM8ZPYoOuNSl7O0/lfe/N6TPvVMvZOVhjtCYd2QppFP00K2RVy', NULL, 1, '5ef4b9ecbc8aa_strawberry-new.jpg', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '123456', NULL, 0, 'PZ4XnCU6OmE3NDVwK03rul73498mQjV9PabyKFrh8PfQ7w1s6KQaar661lbE', NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '::1', NULL, 1, '2020-06-25 14:51:24', '2020-06-25 15:16:57'),
(3, 3, NULL, 1, 'hod@test.com', 'hod', 'user', NULL, 'head of department', '$2y$10$./PRjMD2ZdCn67MyrfooVub.BU.US2oq.CjHQ5E0sIFLoFqjCDEZy', NULL, 1, '5ef5f5aad9990_Dominicks isolated photo (1).jpg', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gaurav.sadda@outlook.com', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '::1', NULL, 1, '2020-06-26 13:18:34', '2020-06-26 13:18:34'),
(4, 5, NULL, 1, 'first@company.com', 'meme', 'ber', NULL, 'ccvcx', '$2y$10$lJxuvVrGjlH6i6Zc4gSW/e4vKoCbMgQD9WnjxqB9NWpqnlujyAdF2', NULL, 1, '5ef6f1ed85839_Italian ice brings people out photo.jpg', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gaurav.sadda@outlook.com', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '::1', NULL, 1, '2020-06-27 07:14:53', '2020-06-27 07:14:53'),
(5, 3, NULL, 1, 'namehead@gmail.com', 'head', 'name', NULL, 'test', '$2y$10$imijDCpkAmoIaV7WFinWv.h30qrEOmDiVIbUHoAWTssFkM0UkUT8W', NULL, 1, '5ef6f6776ce36_40.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '99985513', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '::1', NULL, 1, '2020-06-27 07:34:15', '2020-06-27 07:34:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `al_companies`
--
ALTER TABLE `al_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_comp_departments`
--
ALTER TABLE `al_comp_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_comp_plans`
--
ALTER TABLE `al_comp_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_comp_scorecard`
--
ALTER TABLE `al_comp_scorecard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_comp_subscriptions`
--
ALTER TABLE `al_comp_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_comp_teams`
--
ALTER TABLE `al_comp_teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_department_member`
--
ALTER TABLE `al_department_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_email_templates`
--
ALTER TABLE `al_email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_goal_cycles`
--
ALTER TABLE `al_goal_cycles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_ideas`
--
ALTER TABLE `al_ideas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_idea_attachments`
--
ALTER TABLE `al_idea_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_idea_comments`
--
ALTER TABLE `al_idea_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_idea_likes`
--
ALTER TABLE `al_idea_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_idea_topics`
--
ALTER TABLE `al_idea_topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_master_industries`
--
ALTER TABLE `al_master_industries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_master_status`
--
ALTER TABLE `al_master_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_measures`
--
ALTER TABLE `al_measures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_notifications`
--
ALTER TABLE `al_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_objectives`
--
ALTER TABLE `al_objectives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_perspectives`
--
ALTER TABLE `al_perspectives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_supports`
--
ALTER TABLE `al_supports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_supports_replies`
--
ALTER TABLE `al_supports_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_tasks`
--
ALTER TABLE `al_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_task_replies`
--
ALTER TABLE `al_task_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_teams_members`
--
ALTER TABLE `al_teams_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_theme`
--
ALTER TABLE `al_theme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labels`
--
ALTER TABLE `labels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `al_companies`
--
ALTER TABLE `al_companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `al_comp_departments`
--
ALTER TABLE `al_comp_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `al_comp_plans`
--
ALTER TABLE `al_comp_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `al_comp_scorecard`
--
ALTER TABLE `al_comp_scorecard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `al_comp_subscriptions`
--
ALTER TABLE `al_comp_subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `al_comp_teams`
--
ALTER TABLE `al_comp_teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `al_department_member`
--
ALTER TABLE `al_department_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `al_master_industries`
--
ALTER TABLE `al_master_industries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `al_measures`
--
ALTER TABLE `al_measures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `al_objectives`
--
ALTER TABLE `al_objectives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `al_supports`
--
ALTER TABLE `al_supports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `al_supports_replies`
--
ALTER TABLE `al_supports_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `al_tasks`
--
ALTER TABLE `al_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `al_task_replies`
--
ALTER TABLE `al_task_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `al_teams_members`
--
ALTER TABLE `al_teams_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `al_theme`
--
ALTER TABLE `al_theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `labels`
--
ALTER TABLE `labels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
