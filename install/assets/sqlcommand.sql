-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 24, 2020 at 06:52 AM
-- Server version: 5.7.29-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `azsuppor_societydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `soc_caste_tbl`
--

CREATE TABLE `soc_caste_tbl` (
  `id` int(11) NOT NULL,
  `caste_name` varchar(150) NOT NULL,
  `delflag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_company_tbl`
--

CREATE TABLE `soc_company_tbl` (
  `id` int(11) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `short_name` varchar(50) NOT NULL,
  `company_address` text NOT NULL,
  `logopath` text NOT NULL,
  `logoname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_country`
--

CREATE TABLE `soc_country` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `soc_dcb_view`
--

CREATE TABLE `soc_dcb_view` (
  `mmyy` varchar(6) DEFAULT NULL,
  `loan_op` decimal(10,2) DEFAULT NULL,
  `sharecap` decimal(10,2) DEFAULT NULL,
  `thriftop` decimal(10,2) DEFAULT NULL,
  `cb_name` varchar(150) DEFAULT NULL,
  `account_id` varchar(6) DEFAULT NULL,
  `account_name` varchar(100) DEFAULT NULL,
  `trans_ref` varchar(100) DEFAULT NULL,
  `trans_date` date DEFAULT NULL,
  `cash_bank` varchar(6) DEFAULT NULL,
  `thrift` decimal(32,2) DEFAULT NULL,
  `interest` decimal(32,2) DEFAULT NULL,
  `principle` decimal(32,2) DEFAULT NULL,
  `insurance` decimal(32,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_demandtemp_tbl`
--

CREATE TABLE `soc_demandtemp_tbl` (
  `id` int(11) NOT NULL,
  `demand_date` date NOT NULL,
  `member_id` int(11) NOT NULL,
  `thrift_amount` decimal(10,2) NOT NULL,
  `principle_amount` decimal(10,2) NOT NULL,
  `interest_amount` decimal(10,2) NOT NULL,
  `insurance_amount` decimal(10,2) NOT NULL,
  `misc_amount` decimal(10,2) NOT NULL,
  `month_year` varchar(6) NOT NULL,
  `process_status` int(11) NOT NULL DEFAULT '0',
  `delflag` int(11) NOT NULL DEFAULT '0',
  `demand_timestamp` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_demand_tbl`
--

CREATE TABLE `soc_demand_tbl` (
  `id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `desgn_id` int(11) NOT NULL,
  `subsection_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `insurance_amt` decimal(10,2) NOT NULL,
  `thrift_amt` decimal(10,2) NOT NULL,
  `principle_amt` decimal(10,2) NOT NULL,
  `interest_amt` decimal(10,2) NOT NULL,
  `receipt_no` varchar(50) NOT NULL,
  `demand_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_department_tbl`
--

CREATE TABLE `soc_department_tbl` (
  `id` int(11) NOT NULL,
  `department_name` varchar(150) NOT NULL,
  `subdivision_id` int(11) NOT NULL,
  `delflag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_designation_tbl`
--

CREATE TABLE `soc_designation_tbl` (
  `id` int(11) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `delflag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_division_tbl`
--

CREATE TABLE `soc_division_tbl` (
  `id` int(11) NOT NULL,
  `division_id` varchar(6) NOT NULL,
  `division_name` varchar(100) NOT NULL,
  `delflag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_dmdrec_view`
--

CREATE TABLE `soc_dmdrec_view` (
  `demand_date` date DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `thrift_amount` decimal(10,2) DEFAULT NULL,
  `principle_amount` decimal(10,2) DEFAULT NULL,
  `interest_amount` decimal(10,2) DEFAULT NULL,
  `insurance_amount` decimal(10,2) DEFAULT NULL,
  `thrift` decimal(32,2) DEFAULT NULL,
  `interest` decimal(32,2) DEFAULT NULL,
  `principle` decimal(32,2) DEFAULT NULL,
  `insurance` decimal(32,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_events_tbl`
--

CREATE TABLE `soc_events_tbl` (
  `id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `event_name` text CHARACTER SET utf8 NOT NULL,
  `delflag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_itemmaster_tbl`
--

CREATE TABLE `soc_itemmaster_tbl` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_amount` decimal(10,2) NOT NULL,
  `delflag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_itemtrans_tbl`
--

CREATE TABLE `soc_itemtrans_tbl` (
  `id` int(11) NOT NULL,
  `trans_date` date NOT NULL,
  `trans_refid` int(11) NOT NULL,
  `trans_ref` varchar(100) NOT NULL,
  `trans_amount` decimal(10,2) NOT NULL,
  `trans_type` varchar(4) NOT NULL,
  `account_id` varchar(6) NOT NULL,
  `member_id` varchar(6) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `cash_bank` varchar(6) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `trans_remarks` varchar(150) NOT NULL,
  `mmyy` varchar(6) NOT NULL,
  `delflag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `soc_itemtrans_tbl`
--
DELIMITER $$
CREATE TRIGGER `insert_thrift_tbl` AFTER INSERT ON `soc_itemtrans_tbl` FOR EACH ROW BEGIN
    DECLARE mem_id INTEGER(4);
    
    DECLARE loan_op,thrift_op,thrift_amt,principle_amt DECIMAL(10,2);
    SELECT acclink_id 
    INTO mem_id
    FROM soc_ledgermaster_tbl
    WHERE acclink_id=NEW.account_id;

SELECT loan_opbal,thrift_opbal 
    INTO loan_op,thrift_op
    FROM soc_members_tbl
    WHERE member_id=NEW.account_id;
    
    
    IF (NEW.item_name="THRIFT" AND mem_id=NEW.account_id ) THEN
    INSERT INTO soc_thrift_tbl(trans_refid,member_id,trans_date,trans_amount)
    VALUES(NEW.trans_ref,mem_id,NEW.trans_date,NEW.trans_amount);
    END IF;
    IF (NEW.item_name="PRINCIPLE" AND mem_id=NEW.account_id) THEN
    INSERT INTO soc_principle_tbl(trans_refid,member_id,trans_date,trans_amount)
    VALUES(NEW.trans_ref,mem_id,NEW.trans_date,NEW.trans_amount);
    END IF;
    
   SELECT SUM(trans_amount) INTO thrift_amt FROM soc_thrift_tbl WHERE member_id=mem_id;
   SELECT SUM(trans_amount) INTO principle_amt FROM soc_principle_tbl WHERE member_id=mem_id;
   UPDATE soc_members_tbl SET thrift_deposit=(thrift_op+thrift_amt), loan_outstanding=(loan_op-principle_amt) WHERE member_id=mem_id;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_thriftprinciple_tbl` AFTER UPDATE ON `soc_itemtrans_tbl` FOR EACH ROW BEGIN
    DECLARE mem_id INTEGER(4);
    
    DECLARE loan_op,thrift_op,thrift_amt,principle_amt DECIMAL(10,2);
    SELECT acclink_id 
    INTO mem_id
    FROM soc_ledgermaster_tbl
    WHERE acclink_id=NEW.account_id;

SELECT loan_opbal,thrift_opbal 
    INTO loan_op,thrift_op
    FROM soc_members_tbl
    WHERE member_id=NEW.account_id;
    
    
    IF (NEW.item_name="THRIFT" AND mem_id=NEW.account_id ) THEN
IF (old.trans_amount<>NEW.trans_amount) THEN
  UPDATE soc_thrift_tbl SET trans_amount=NEW.trans_amount,trans_date=NEW.trans_date WHERE member_id=NEW.account_id AND trans_refid=NEW.trans_ref;
END IF;
    END IF;
    IF (NEW.item_name="PRINCIPLE" AND mem_id=NEW.account_id) THEN
IF (old.trans_amount<>NEW.trans_amount) THEN
  UPDATE soc_principle_tbl SET trans_amount=NEW.trans_amount,trans_date=NEW.trans_date WHERE member_id=NEW.account_id AND trans_refid=NEW.trans_ref;
END IF;
    END IF;
    
   SELECT SUM(trans_amount) INTO thrift_amt FROM soc_thrift_tbl WHERE member_id=mem_id;
   SELECT SUM(trans_amount) INTO principle_amt FROM soc_principle_tbl WHERE member_id=mem_id;
   UPDATE soc_members_tbl SET thrift_deposit=(thrift_op+thrift_amt), loan_outstanding=(loan_op-principle_amt) WHERE member_id=mem_id;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `soc_journalentry_tbl`
--

CREATE TABLE `soc_journalentry_tbl` (
  `id` int(11) NOT NULL,
  `journal_number` varchar(20) NOT NULL,
  `journal_date` date NOT NULL,
  `debitaccount_number` varchar(6) NOT NULL,
  `debit_accountname` varchar(150) NOT NULL,
  `debit_amount` decimal(10,2) NOT NULL,
  `creditaccount_number` varchar(6) NOT NULL,
  `credit_accountname` varchar(150) NOT NULL,
  `credit_amount` decimal(10,2) NOT NULL,
  `dc` varchar(1) NOT NULL,
  `journal_narration` varchar(200) NOT NULL,
  `delflag` int(11) NOT NULL DEFAULT '0',
  `journal_timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `soc_journalentry_tbl`
--
DELIMITER $$
CREATE TRIGGER `delete_transaction_tbl` AFTER DELETE ON `soc_journalentry_tbl` FOR EACH ROW BEGIN

DECLARE mem_id INTEGER(4);
    
DECLARE loan_op,thrift_op,thrift_amt,principle_amt DECIMAL(10,2);

DELETE FROM soc_transaction_tbl WHERE trans_ref = old.journal_number AND trans_date=old.journal_date;
 DELETE FROM soc_itemtrans_tbl WHERE trans_ref = old.journal_number AND trans_date=old.journal_date;
 DELETE FROM soc_thrift_tbl WHERE trans_refid = old.journal_number AND trans_date=old.journal_date; 
 DELETE FROM soc_principle_tbl WHERE trans_refid = old.journal_number AND trans_date=old.journal_date; 


SELECT acclink_id 
    INTO mem_id
    FROM soc_ledgermaster_tbl
    WHERE acclink_id=old.creditaccount_number;

SELECT loan_opbal,thrift_opbal 
    INTO loan_op,thrift_op
    FROM soc_members_tbl
    WHERE member_id=old.creditaccount_number;
    
    
   SELECT SUM(trans_amount) INTO thrift_amt FROM soc_thrift_tbl WHERE member_id=mem_id;
   SELECT SUM(trans_amount) INTO principle_amt FROM soc_principle_tbl WHERE member_id=mem_id;
   UPDATE soc_members_tbl SET thrift_deposit=(thrift_op+thrift_amt), loan_outstanding=(loan_op-principle_amt) WHERE member_id=mem_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_transaction_tbl` AFTER INSERT ON `soc_journalentry_tbl` FOR EACH ROW INSERT INTO soc_transaction_tbl (trans_refid,trans_ref,trans_date,trans_amount,account_id,account_name,cash_bank_id,cash_bank,trans_type,trans_remarks)
VALUES (NEW.id,NEW.journal_number,NEW.journal_date,NEW.debit_amount,NEW.debitaccount_number,NEW.debit_accountname,NEW.creditaccount_number,NEW.credit_accountname,'JOURNAL',NEW.journal_narration)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_transaction_tbl` AFTER UPDATE ON `soc_journalentry_tbl` FOR EACH ROW UPDATE soc_transaction_tbl SET trans_date= NEW.journal_date,trans_ref= NEW.journal_number,trans_amount= NEW.debit_amount,account_id= NEW.debitaccount_number,account_name= NEW.debit_accountname,cash_bank_id= NEW.creditaccount_number,cash_bank= NEW.credit_accountname,trans_type= "JOURNAL",trans_remarks= NEW.journal_narration WHERE trans_refid= NEW.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `soc_ledgermaster_tbl`
--

CREATE TABLE `soc_ledgermaster_tbl` (
  `id` int(11) NOT NULL,
  `account_name` varchar(150) NOT NULL,
  `account_type` varchar(2) NOT NULL,
  `acclink_id` varchar(6) NOT NULL,
  `delflag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_loanapplication_tbl`
--

CREATE TABLE `soc_loanapplication_tbl` (
  `id` int(11) NOT NULL,
  `app_number` varchar(100) NOT NULL,
  `member_id` int(11) NOT NULL,
  `member_name` varchar(150) NOT NULL,
  `member_fahuname` varchar(150) NOT NULL,
  `fh_flag` int(11) NOT NULL,
  `member_dob` date NOT NULL,
  `loan_amount` decimal(10,2) NOT NULL,
  `roi` decimal(5,0) NOT NULL,
  `loan_purpose` varchar(150) NOT NULL,
  `repay_period` varchar(10) NOT NULL,
  `installment_amount` decimal(10,2) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `off_address` text NOT NULL,
  `off_state` varchar(100) NOT NULL,
  `off_city` varchar(100) NOT NULL,
  `off_pincode` varchar(7) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `basic_amt` decimal(10,2) NOT NULL,
  `da_amt` decimal(10,2) NOT NULL,
  `hra_amt` decimal(10,2) NOT NULL,
  `splpay_amt` decimal(10,2) NOT NULL,
  `ir_amt` decimal(10,2) NOT NULL,
  `ma_amt` decimal(10,2) NOT NULL,
  `gpfsub_amt` decimal(10,2) NOT NULL,
  `gpfloan_amt` decimal(10,2) NOT NULL,
  `fbs_amt` decimal(10,2) NOT NULL,
  `fa_amt` decimal(10,2) NOT NULL,
  `hba_amt` decimal(10,2) NOT NULL,
  `ca_amt` decimal(10,2) NOT NULL,
  `lic_amt` decimal(10,2) NOT NULL,
  `socrec_amt` decimal(10,2) NOT NULL,
  `other_amt` decimal(10,2) NOT NULL,
  `earn_amt` decimal(10,2) NOT NULL,
  `ded_amt` decimal(10,2) NOT NULL,
  `net_amt` decimal(10,2) NOT NULL,
  `dor` date NOT NULL,
  `app_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Loan Application';

-- --------------------------------------------------------

--
-- Table structure for table `soc_members_tbl`
--

CREATE TABLE `soc_members_tbl` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `member_name` varchar(150) NOT NULL,
  `father_husband` int(11) NOT NULL,
  `fahu_name` varchar(150) NOT NULL,
  `gender` int(11) NOT NULL,
  `marital` int(11) NOT NULL,
  `dob` date NOT NULL,
  `doj` date NOT NULL,
  `religion` int(11) NOT NULL,
  `caste` int(11) NOT NULL,
  `subcaste` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `subdivision_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `landline_no` varchar(12) NOT NULL,
  `email_id` varchar(200) NOT NULL,
  `resident_add` text NOT NULL,
  `photo_path` text NOT NULL,
  `sign_path` text NOT NULL,
  `idproof_path` text NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `account_name` varchar(150) NOT NULL,
  `account_no` varchar(20) NOT NULL,
  `ifscode` varchar(15) NOT NULL,
  `branch_addr` varchar(200) NOT NULL,
  `surety_id` int(11) NOT NULL,
  `surety_name` varchar(150) NOT NULL,
  `share_capital` decimal(10,2) NOT NULL,
  `thrift_deposit` decimal(10,2) NOT NULL,
  `thrift_opbal` decimal(10,2) NOT NULL,
  `thrift_monthly` decimal(10,2) NOT NULL DEFAULT '1500.00',
  `loan_opbal` decimal(10,2) NOT NULL,
  `loan_outstanding` decimal(10,2) NOT NULL,
  `rate_of_interest` decimal(5,2) NOT NULL,
  `no_installment` int(11) NOT NULL,
  `principle_amount` decimal(10,2) NOT NULL,
  `loan_amount` decimal(10,2) NOT NULL,
  `surety_flag` varchar(1) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `delflag` int(11) NOT NULL DEFAULT '0',
  `curr_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `soc_members_tbl`
--
DELIMITER $$
CREATE TRIGGER `insert_mem_ledgermaster_tbl` AFTER INSERT ON `soc_members_tbl` FOR EACH ROW BEGIN

    INSERT INTO soc_ledgermaster_tbl(account_name,account_type,acclink_id)
    VALUES(NEW.member_name,"DB",NEW.member_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `soc_officenote_master_tbl`
--

CREATE TABLE `soc_officenote_master_tbl` (
  `id` int(11) NOT NULL,
  `duetoaccount` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_officenote_trans_tbl`
--

CREATE TABLE `soc_officenote_trans_tbl` (
  `id` int(11) NOT NULL,
  `officenote_id` int(11) NOT NULL,
  `loan_appno` varchar(100) NOT NULL,
  `onote_date` date NOT NULL,
  `member_id` int(11) NOT NULL,
  `member_name` varchar(150) NOT NULL,
  `sur_member_id` int(11) NOT NULL,
  `sur_member_name` varchar(150) NOT NULL,
  `loan_sanctioned` decimal(10,2) NOT NULL,
  `roi_pc` decimal(5,2) NOT NULL,
  `res_number` varchar(100) NOT NULL,
  `res_date` date NOT NULL,
  `amount_adjusted` decimal(10,2) NOT NULL,
  `mt_loanoutstanding` decimal(10,2) NOT NULL,
  `mt_loaninterest` decimal(10,2) NOT NULL,
  `mt_sharecapital` decimal(10,2) NOT NULL,
  `sur_sharecapital` decimal(10,2) NOT NULL,
  `fxd_deposit` decimal(10,2) NOT NULL,
  `drs_deposit` decimal(10,2) NOT NULL,
  `other_amount` decimal(10,2) NOT NULL,
  `chq_amt` decimal(10,2) NOT NULL,
  `chq_issued` varchar(100) NOT NULL,
  `chq_no` varchar(12) NOT NULL,
  `chq_date` date NOT NULL,
  `amt_inrupees` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `curr_datestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_payment_tbl`
--

CREATE TABLE `soc_payment_tbl` (
  `id` int(11) NOT NULL,
  `payment_number` varchar(20) NOT NULL,
  `payment_date` date NOT NULL,
  `account_id` varchar(11) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `cash_bank` varchar(11) NOT NULL,
  `narration` varchar(150) NOT NULL,
  `curr_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delflag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_principle_tbl`
--

CREATE TABLE `soc_principle_tbl` (
  `id` int(11) NOT NULL,
  `trans_refid` varchar(20) NOT NULL,
  `member_id` varchar(6) NOT NULL,
  `trans_date` date NOT NULL,
  `trans_amount` decimal(10,2) NOT NULL,
  `delflag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_receipt_tbl`
--

CREATE TABLE `soc_receipt_tbl` (
  `id` int(11) NOT NULL,
  `receipt_number` varchar(100) NOT NULL,
  `receipt_date` date NOT NULL,
  `account_id` varchar(11) NOT NULL,
  `account_name` varchar(150) NOT NULL,
  `receipt_amount` decimal(10,2) NOT NULL,
  `cash_bank` varchar(11) NOT NULL,
  `narration` text NOT NULL,
  `curr_timestamp` datetime DEFAULT NULL,
  `delflag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_recovery_tbl`
--

CREATE TABLE `soc_recovery_tbl` (
  `id` int(11) NOT NULL,
  `member_id` varchar(6) NOT NULL,
  `member_name` varchar(100) NOT NULL,
  `trans_ref` varchar(100) NOT NULL,
  `recovery_date` date NOT NULL,
  `thrift_amount` decimal(10,2) NOT NULL,
  `principle_amount` decimal(10,2) NOT NULL,
  `interest_amount` decimal(10,2) NOT NULL,
  `insurance_amount` decimal(10,2) NOT NULL,
  `misc_amount` decimal(10,2) NOT NULL,
  `month_year` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `soc_religion_tbl`
--

CREATE TABLE `soc_religion_tbl` (
  `id` int(11) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `delflag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_section_tbl`
--

CREATE TABLE `soc_section_tbl` (
  `id` int(11) NOT NULL,
  `section_name` varchar(100) NOT NULL,
  `delflag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_settings`
--

CREATE TABLE `soc_settings` (
  `settings_id` int(11) NOT NULL,
  `type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_settings_tbl`
--

CREATE TABLE `soc_settings_tbl` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `division_prefix` varchar(3) NOT NULL,
  `payment_prefix` varchar(3) NOT NULL,
  `receipt_prefix` varchar(3) NOT NULL,
  `journal_prefix` varchar(3) NOT NULL,
  `receipt_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `app_number` int(11) NOT NULL,
  `journal_id` int(11) NOT NULL,
  `officenote_id` int(11) NOT NULL,
  `year` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_smsdata_tbl`
--

CREATE TABLE `soc_smsdata_tbl` (
  `id` int(11) NOT NULL,
  `sms_datetime` datetime DEFAULT NULL,
  `sms_date` date NOT NULL,
  `sms_to` varchar(10) NOT NULL,
  `sms_text` text CHARACTER SET utf8mb4 NOT NULL,
  `sms_msgid` varchar(150) NOT NULL,
  `sms_status` int(11) NOT NULL DEFAULT '0',
  `delflag` int(11) NOT NULL DEFAULT '0',
  `update_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_smstemplates_tbl`
--

CREATE TABLE `soc_smstemplates_tbl` (
  `id` int(11) NOT NULL,
  `template_name` varchar(50) NOT NULL,
  `template_message` text CHARACTER SET utf8mb4 NOT NULL,
  `delflag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_sms_settings_tbl`
--

CREATE TABLE `soc_sms_settings_tbl` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `api_authkey` text NOT NULL,
  `api_url` text NOT NULL,
  `sendername` varchar(6) NOT NULL,
  `setdefault` int(11) NOT NULL DEFAULT '0',
  `delflag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_soc_itemtrans_tbl`
--

CREATE TABLE `soc_soc_itemtrans_tbl` (
  `id` int(11) NOT NULL,
  `trans_date` date NOT NULL,
  `trans_refid` int(11) NOT NULL,
  `trans_ref` varchar(100) NOT NULL,
  `trans_amount` decimal(10,2) NOT NULL,
  `trans_type` varchar(4) NOT NULL,
  `account_id` varchar(6) NOT NULL,
  `member_id` varchar(6) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `cash_bank` varchar(6) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `trans_remarks` varchar(150) NOT NULL,
  `mmyy` varchar(6) NOT NULL,
  `delflag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_soc_settings_tbl`
--

CREATE TABLE `soc_soc_settings_tbl` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `division_prefix` varchar(3) NOT NULL,
  `payment_prefix` varchar(3) NOT NULL,
  `receipt_prefix` varchar(3) NOT NULL,
  `journal_prefix` varchar(3) NOT NULL,
  `receipt_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `app_number` int(11) NOT NULL,
  `journal_id` int(11) NOT NULL,
  `officenote_id` int(11) NOT NULL,
  `year` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_status_tbl`
--

CREATE TABLE `soc_status_tbl` (
  `id` int(11) NOT NULL,
  `status_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_subcaste_tbl`
--

CREATE TABLE `soc_subcaste_tbl` (
  `id` int(11) NOT NULL,
  `subcaste_name` varchar(150) NOT NULL,
  `delflag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_subdivision_tbl`
--

CREATE TABLE `soc_subdivision_tbl` (
  `id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `subdivision_name` varchar(100) NOT NULL,
  `delflag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_thrift_tbl`
--

CREATE TABLE `soc_thrift_tbl` (
  `id` int(11) NOT NULL,
  `trans_refid` varchar(20) NOT NULL,
  `member_id` varchar(6) NOT NULL,
  `trans_date` date NOT NULL,
  `trans_amount` decimal(10,2) NOT NULL,
  `delflag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_transaction_tbl`
--

CREATE TABLE `soc_transaction_tbl` (
  `id` int(11) NOT NULL,
  `trans_refid` int(11) NOT NULL,
  `trans_date` date NOT NULL,
  `trans_ref` varchar(15) NOT NULL,
  `dbcr` varchar(2) NOT NULL,
  `trans_amount` decimal(10,2) NOT NULL,
  `account_id` varchar(6) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `cash_bank_id` varchar(6) NOT NULL,
  `cash_bank` varchar(100) NOT NULL,
  `trans_type` varchar(7) NOT NULL,
  `trans_remarks` varchar(200) NOT NULL,
  `delflag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc_user`
--

CREATE TABLE `soc_user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `member_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `country` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `soc_user_power`
--

CREATE TABLE `soc_user_power` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `power_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `soc_user_role`
--

CREATE TABLE `soc_user_role` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
