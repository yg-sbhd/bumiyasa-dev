-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 14 Mei 2018 pada 04.59
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kluos`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_authorization`
--

CREATE TABLE `ref_authorization` (
  `auth_id` int(11) NOT NULL,
  `auth_name` varchar(50) DEFAULT NULL,
  `notes` text,
  `parent_id` int(11) DEFAULT '0',
  `tmp` varchar(128) DEFAULT NULL,
  `insert_date` datetime DEFAULT NULL,
  `insert_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_authorization`
--

INSERT INTO `ref_authorization` (`auth_id`, `auth_name`, `notes`, `parent_id`, `tmp`, `insert_date`, `insert_by`) VALUES
(1, 'PO Buyer (SPM)', NULL, 0, 'templates/po_buyer/index.php', NULL, NULL),
(2, 'New', NULL, 1, 'templates/po_buyer/index.php', NULL, NULL),
(3, 'Edit', NULL, 1, 'templates/po_buyer/index.php', NULL, NULL),
(4, 'Delete', NULL, 1, 'templates/po_buyer/index.php', NULL, NULL),
(5, 'View', NULL, 1, 'templates/po_buyer/index.php', NULL, NULL),
(6, 'PO Supplier (SPB)', NULL, 0, 'templates/po_supplier/index.php', NULL, NULL),
(7, 'New', NULL, 6, 'templates/po_supplier/index.php', NULL, NULL),
(8, 'Edit', NULL, 6, 'templates/po_supplier/index.php', NULL, NULL),
(9, 'Delete', NULL, 6, 'templates/po_supplier/index.php', NULL, NULL),
(10, 'View', NULL, 6, 'templates/po_supplier/index.php', NULL, NULL),
(11, 'Delivery Order (DO)', NULL, 0, 'templates/do/index.php', NULL, NULL),
(12, 'New', NULL, 11, 'templates/do/index.php', NULL, NULL),
(13, 'Edit', NULL, 11, 'templates/do/index.php', NULL, NULL),
(14, 'Delete', NULL, 11, 'templates/do/index.php', NULL, NULL),
(15, 'View', NULL, 11, 'templates/do/index.php', NULL, NULL),
(16, 'Supplier Invoice', NULL, 0, 'templates/invoice_supplier/index.php', NULL, NULL),
(17, 'New', NULL, 16, 'templates/invoice_supplier/index.php', NULL, NULL),
(18, 'Edit', NULL, 16, 'templates/invoice_supplier/index.php', NULL, NULL),
(19, 'Delete', NULL, 16, 'templates/invoice_supplier/index.php', NULL, NULL),
(20, 'View', NULL, 16, 'templates/invoice_supplier/index.php', NULL, NULL),
(21, 'Invoice KLU', NULL, 0, 'templates/invoice/index.php', NULL, NULL),
(22, 'New', NULL, 21, 'templates/invoice/index.php', NULL, NULL),
(23, 'Edit', NULL, 21, 'templates/invoice/index.php', NULL, NULL),
(24, 'Delete', NULL, 21, 'templates/invoice/index.php', NULL, NULL),
(25, 'View', NULL, 21, 'templates/invoice/index.php', NULL, NULL),
(26, 'Project Monitoring', NULL, 0, 'templates/project/index.php', NULL, NULL),
(27, 'Project Analysis', NULL, 26, 'templates/project/index.php', NULL, NULL),
(28, 'Payment Analysis', NULL, 26, 'templates/project/invanalysis.php', NULL, NULL),
(29, 'QR Code', NULL, 6, 'templates/po_supplier/index.php', NULL, NULL),
(30, 'Print', NULL, 6, 'templates/po_supplier/index.php', NULL, NULL),
(31, 'Print', NULL, 11, 'templates/do/index.php', NULL, NULL),
(32, 'Print', NULL, 16, 'templates/invoice_supplier/index.php', NULL, NULL),
(33, 'Print', NULL, 21, 'templates/invoice/index.php', NULL, NULL),
(34, 'Recap & Report', NULL, 0, 'templates/print/index.php', NULL, NULL),
(35, 'Print', NULL, 1, 'templates/po_buyer/index.php', NULL, NULL),
(36, 'Close SPM', NULL, 1, 'templates/po_buyer/index.php', NULL, NULL),
(37, 'Master Table & Web Admin', NULL, 0, NULL, NULL, NULL),
(39, 'Recap SPM', NULL, 34, 'templates/print/report_spm.php', NULL, NULL),
(40, 'Recap SPB', NULL, 34, 'templates/print/report_spb.php', NULL, NULL),
(41, 'Recap Invoice VS DO', NULL, 34, 'templates/print/report_invdo.php', NULL, NULL),
(42, 'Recap Supl. Invoice VS DO', NULL, 34, 'templates/print/report_supinvdo.php', NULL, NULL),
(43, 'Paid', NULL, 21, 'templates/invoice/index.php', NULL, NULL),
(44, 'Paid', NULL, 16, 'templates/invoice_supplier/index.php', NULL, NULL),
(45, 'Executive Dashboard', NULL, 0, 'templates/dashboard/index-chart.php', NULL, NULL),
(46, 'Recap KLU Invoice', NULL, 34, 'index-template.php?tmp=templates/print/recap_invoice.php', NULL, NULL),
(47, 'Recap Supplier Invoice', NULL, 34, 'index-template.php?tmp=templates/print/recap_supinvoice.php', NULL, NULL),
(48, 'Recap DO', NULL, 34, 'index-template.php?tmp=templates/print/recap_do.php', NULL, NULL),
(49, 'Close SPB', NULL, 6, 'templates/po_supplier/index.php', NULL, NULL),
(51, 'Monitoring', NULL, 0, 'templates/ref_monitoring/monitoring_buyer_dashboard.php', NULL, NULL),
(52, 'Monitoring Buyer Dashboard', NULL, 51, 'templates/ref_monitoring/monitoring_buyer_dashboard.php', NULL, NULL),
(53, 'New', NULL, 52, 'templates/ref_monitoring/monitoring_buyer_dashboard.php', NULL, NULL),
(54, 'Edit', NULL, 52, 'templates/ref_monitoring/monitoring_buyer_dashboard.php', NULL, NULL),
(55, 'Delete', NULL, 52, 'templates/ref_monitoring/monitoring_buyer_dashboard.php', NULL, NULL),
(56, 'View', NULL, 52, 'templates/ref_monitoring/monitoring_buyer_dashboard.php', NULL, NULL),
(57, 'Monitoring Buyer Invoice', NULL, 51, 'templates/ref_monitoring/monitoring_buyer_invoice.php', NULL, NULL),
(58, 'New', NULL, 57, 'templates/ref_monitoring/monitoring_buyer_invoice.php', NULL, NULL),
(59, 'Edit', NULL, 57, 'templates/ref_monitoring/monitoring_buyer_invoice.php', NULL, NULL),
(60, 'Delete', NULL, 57, 'templates/ref_monitoring/monitoring_buyer_invoice.php', NULL, NULL),
(61, 'View', NULL, 57, 'templates/ref_monitoring/monitoring_buyer_invoice.php', NULL, NULL),
(62, 'Target Belanja & Realisasi / Pencapaian', NULL, 51, 'templates/ref_monitoring/monitoring_target_belanja.php', NULL, NULL),
(63, 'New', NULL, 62, 'templates/ref_monitoring/monitoring_target_belanja.php', NULL, NULL),
(64, 'Edit', NULL, 62, 'templates/ref_monitoring/monitoring_target_belanja.php', NULL, NULL),
(65, 'Delete', NULL, 62, 'templates/ref_monitoring/monitoring_target_belanja.php', NULL, NULL),
(66, 'View', NULL, 62, 'templates/ref_monitoring/monitoring_target_belanja.php', NULL, NULL),
(67, 'Monitoring Sales Performance', NULL, 51, 'templates/ref_monitoring/monitoring_sales.php', NULL, NULL),
(68, 'New', NULL, 67, 'templates/ref_monitoring/monitoring_sales.php', NULL, NULL),
(69, 'Edit', NULL, 67, 'templates/ref_monitoring/monitoring_sales.php', NULL, NULL),
(70, 'Delete', NULL, 67, 'templates/ref_monitoring/monitoring_sales.php', NULL, NULL),
(71, 'View', NULL, 67, 'templates/ref_monitoring/monitoring_sales.php', NULL, NULL),
(72, 'Monitoring FO Report', NULL, 51, 'templates/ref_monitoring/monitoring_fo_report.php', NULL, NULL),
(73, 'New', NULL, 72, 'templates/ref_monitoring/monitoring_fo_report.php', NULL, NULL),
(74, 'Edit', NULL, 72, 'templates/ref_monitoring/monitoring_fo_report.php', NULL, NULL),
(75, 'Delete', NULL, 72, 'templates/ref_monitoring/monitoring_fo_report.php', NULL, NULL),
(76, 'View', NULL, 72, 'templates/ref_monitoring/monitoring_fo_report.php', NULL, NULL),
(77, 'Buyer Invoice For Finance', NULL, 51, 'templates/ref_monitoring/buyer_invoice_finance.php', NULL, NULL),
(78, 'New', NULL, 77, 'templates/ref_monitoring/buyer_invoice_finance.php', NULL, NULL),
(79, 'Edit', NULL, 77, 'templates/ref_monitoring/buyer_invoice_finance.php', NULL, NULL),
(80, 'Delete', NULL, 77, 'templates/ref_monitoring/buyer_invoice_finance.php', NULL, NULL),
(81, 'View', NULL, 77, 'templates/ref_monitoring/buyer_invoice_finance.php', NULL, NULL),
(82, 'Buyer Invoice For Admin', NULL, 51, 'templates/ref_monitoring/buyer_invoice_admin.php', NULL, NULL),
(83, 'New', NULL, 82, 'templates/ref_monitoring/buyer_invoice_admin.php', NULL, NULL),
(84, 'Edit', NULL, 82, 'templates/ref_monitoring/buyer_invoice_admin.php', NULL, NULL),
(85, 'Delete', NULL, 82, 'templates/ref_monitoring/buyer_invoice_admin.php', NULL, NULL),
(86, 'View', NULL, 82, 'templates/ref_monitoring/buyer_invoice_admin.php', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ref_authorization`
--
ALTER TABLE `ref_authorization`
  ADD PRIMARY KEY (`auth_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ref_authorization`
--
ALTER TABLE `ref_authorization`
  MODIFY `auth_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
