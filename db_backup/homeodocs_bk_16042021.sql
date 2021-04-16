-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 16, 2021 at 03:05 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homeodocs`
--

-- --------------------------------------------------------

--
-- Table structure for table `homeo_action_logs`
--

CREATE TABLE `homeo_action_logs` (
  `id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `controller` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `homeo_advertisements`
--

CREATE TABLE `homeo_advertisements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `heading` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_banner` tinyint(4) NOT NULL DEFAULT '0',
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homeo_advertisements`
--

INSERT INTO `homeo_advertisements` (`id`, `title`, `description`, `heading`, `image_name`, `image_url`, `is_banner`, `admin_id`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'COVID', 'Coronavirus disease (COVID-19) is an infectious disease caused by a newly discovered coronavirus.\n\nMost people infected with the COVID-19 virus will experience mild to moderate respiratory illness and recover without requiring special treatment.  Older people, and those with underlying medical problems like cardiovascular disease, diabetes, chronic respiratory disease, and cancer are more likely to develop serious illness.\n\nThe best way to prevent and slow down transmission is to be well informed about the COVID-19 virus, the disease it causes and how it spreads. Protect yourself and others from infection by washing your hands or using an alcohol based rub frequently and not touching your face. \n\nThe COVID-19 virus spreads primarily through droplets of saliva or discharge from the nose when an infected person coughs or sneezes, so it’s important that you also practice respiratory etiquette (for example, by coughing into a flexed elbow).', 'COVID-19', 'COVID_1609822083.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/advertisement/COVID_1609822083.png', 0, 2, 1, 0, '2021-01-05 04:48:04', '2021-01-05 04:52:07'),
(2, 'Homeopathy Cure', 'Homeopathy is a medical system based on the belief that the body can cure itself. Those who practice it use tiny amounts of natural substances, like plants and minerals. They believe these stimulate the healing process.\n\nIt was developed in the late 1700s in Germany. It’s common in many European countries, but it’s not quite as popular in the United States.\n\nHow Does It Work?\n\nA basic belief behind homeopathy is “like cures like.” In other words, something that brings on symptoms in a healthy person can -- in a very small dose -- treat an illness with similar symptoms. This is meant to trigger the body’s natural defenses.', 'Homeopathy Cure', 'Homeopathy Cure_1609822480.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/advertisement/Homeopathy%20Cure_1609822480.png', 0, 2, 1, 0, '2021-01-05 04:54:40', '2021-01-05 04:54:40'),
(3, 'Consultation', 'Consultation', 'Consultation', 'Consultation_1609824633.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/advertisement/Consultation_1609824633.png', 1, 2, 1, 0, '2021-01-05 04:56:11', '2021-01-05 05:30:33'),
(4, 'Top doctor 24x7', 'Top doctor 24x7', 'Top doctor 24x7', 'Top doctor 24x7_1609823902.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/advertisement/Top%20doctor%2024x7_1609823902.png', 1, 2, 1, 0, '2021-01-05 04:56:36', '2021-01-05 05:18:22'),
(5, 'Unlimited Consultation', 'Unlimited Consultation', 'Unlimited Consultation', 'Unlimited Consultation_1609822648.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/advertisement/Unlimited%20Consultation_1609822648.png', 1, 2, 1, 0, '2021-01-05 04:57:28', '2021-01-05 04:57:28');

-- --------------------------------------------------------

--
-- Table structure for table `homeo_categories`
--

CREATE TABLE `homeo_categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `description` tinytext,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `homeo_consults`
--

CREATE TABLE `homeo_consults` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `disease_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disease_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symptoms` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bathing_habit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sleep` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dreams` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menstrual_history` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `obstetric_history` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sexual_history` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `family_history` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_pressure` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pulse_rate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temprature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appetite` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thirst` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addiction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thermalReaction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perspiration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urine` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stool` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homeo_consults`
--

INSERT INTO `homeo_consults` (`id`, `patient_id`, `disease_name`, `disease_type`, `symptoms`, `bathing_habit`, `sleep`, `dreams`, `menstrual_history`, `obstetric_history`, `sexual_history`, `family_history`, `blood_pressure`, `pulse_rate`, `temprature`, `appetite`, `thirst`, `addiction`, `thermalReaction`, `perspiration`, `urine`, `stool`, `desire`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Eye', 'eye', 'red', 'daily', 'sound', 'wet', 'none', 'none', 'none', 'none', '120/90', '72', '98', 'good', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 1, 0, '2021-03-15 16:23:56', '2021-03-15 16:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `homeo_consult_images`
--

CREATE TABLE `homeo_consult_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `consult_id` bigint(20) UNSIGNED NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `homeo_contact_us`
--

CREATE TABLE `homeo_contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `homeo_diseases`
--

CREATE TABLE `homeo_diseases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `diseases_categories_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homeo_diseases`
--

INSERT INTO `homeo_diseases` (`id`, `diseases_categories_id`, `title`, `description`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Eye flu / Conjunctivitis', 'Conjunctivitis, or “pink eye” happens when the conjunctiva of the eye becomes inflamed. The eye can become red or pink, swollen, and irritated, and there may be mucus. Infective conjunctivitis can be highly contagious', 1, 0, '2021-01-05 05:36:20', '2021-01-05 05:36:20'),
(2, 1, 'Stye eyes', 'A stye is an inflammation of the eyelid associated with a small collection of pus. In most cases, the infection is caused by the Staphylococcus bacteria', 1, 0, '2021-01-06 13:59:53', '2021-01-06 13:59:53'),
(3, 1, 'Diabetic Retinopathy', 'Diabetic retinopathy is a diabetes complication that affects eyes. It\'s caused by damage to the blood vessels of the light-sensitive tissue at the back of the eye (retina)', 1, 0, '2021-01-06 14:00:17', '2021-01-11 11:36:27'),
(4, 1, 'Optic Nerve atrophy (Diabetic)', 'Optic neuropathy is clinically classified as an acute, pallid optic disc swelling (followed by optic nerve pallor) with afferent pupillary defects associated with visual field defects', 1, 0, '2021-01-06 14:00:36', '2021-01-06 14:00:36'),
(5, 1, 'Myopia', 'Is it hard to see distant objects, like highway signs, until you’re a few feet away, but easy to read a book up close? Chances are you’re myopic, also known as nearsighted. It’s a pretty common condition that your eye doctor usually can fix with eyeglasses, contacts, or eye surgery', 1, 0, '2021-01-06 14:00:54', '2021-01-06 14:00:54'),
(6, 1, 'Ptosis Eyes', 'Pathologic droopy eyelid, also called ptosis, may occur due to trauma, age, or various medical disorders', 1, 0, '2021-01-06 14:01:12', '2021-01-06 14:01:12'),
(7, 1, 'Corneal Ulcers', 'A corneal ulcer (also known as keratitis) is an open sore on the cornea. The cornea covers the iris and the round pupil, much like a watch crystal covers the face of a watch', 1, 0, '2021-01-06 14:01:29', '2021-01-06 14:01:29'),
(8, 2, 'DNS (daviation of nasal Septum)', 'DNS (Deviated nasal septum) is defined as the deviation of nasal septum from normal/center of the nasal cavity due to allergy, sinusitis.', 1, 0, '2021-01-06 14:02:04', '2021-01-11 11:40:03'),
(9, 2, 'Tumor throat (Benign / Malignant)', 'Benign laryngeal tumors include hoarseness, breathy voice, dyspnea, aspiration, dysphagia, otalgia (ear pain), and hemoptysis, cancer treatment depends on disease stages. Homeopathy treatment based on symptomatic as a holistic approach to cure diseases, this treatment is not a final treatment for you and take further treatment consult to your doctor', 1, 0, '2021-01-06 14:02:26', '2021-01-06 14:02:26'),
(10, 2, 'Suppurative Otitismedia (PUS formation in ears)', 'Chronic otitis media describes some long-term problems with the middle ear, such as a hole (perforation) in the eardrum that does not heal or a middle ear infection (otitis media) that doesn\'t improve or keeps returning', 1, 0, '2021-01-06 14:02:46', '2021-01-06 14:02:46'),
(11, 2, 'Tonsillitis', 'Tonsillitis is inflammation of the tonsils, two oval-shaped pads of tissue at the back of the throat — one tonsil on each side due to bacterial infections.', 1, 0, '2021-01-06 14:03:05', '2021-01-06 14:03:05'),
(12, 2, 'Deafness', 'Deafness is the complete inability to hear sound. Deafness and hearing loss have many causes and can occur at any age', 1, 0, '2021-01-06 14:03:23', '2021-01-06 14:03:23'),
(13, 2, 'Tinnitus Aurium', 'Ringing or buzzing noise in one or both ears that may be constant or come and go, often associated with hearing loss', 1, 0, '2021-01-06 14:03:41', '2021-01-06 14:03:41'),
(14, 3, 'Mouth ulcer, Tumor, Cancer', 'Oral cancer can appear anywhere in the mouth, including the inside of the cheeks and the gums. cancer treatment depends on disease stages. Homeopathy treatment based on symptomatic as a holistic approach to cure diseases, this treatment is not a final treatment for you and take further treatment consult to your doctor', 1, 0, '2021-01-06 14:25:38', '2021-01-06 14:25:38'),
(15, 3, 'Lock jaw due to Tobacco chewing', 'Regular smokers and those prone to popping little packs of gutka into their mouths need to watch out for a warning signal – stiffening jaw muscles', 1, 0, '2021-01-06 14:26:32', '2021-01-06 14:26:32'),
(16, 3, 'Aphthous mouth', 'Aphthous mouth ulcers (aphthae) are a common variety of ulcer that form on the mucous membranes, typically in the oral cavity (mouth)', 1, 0, '2021-01-06 14:27:09', '2021-01-06 14:27:09'),
(17, 3, 'Ulcer tongue, stomatitis', 'Stomatitis is a sore or inflammation inside of the mouth. The sore can be in the cheeks, gums, inside of the lips, or on the tongue', 1, 0, '2021-01-06 14:27:33', '2021-01-06 14:27:33'),
(18, 3, 'Tumor/Cancer Tongue', 'Tongue cancer is a type of mouth cancer, or oral cancer, that usually develops in the squamous cells on the surface of the tongue. cancer treatment depends on disease stages. Homeopathy treatment based on symptomatic as a holistic approach to cure diseases, this treatment is not a final treatment for you and take further treatment consult to your doctor', 1, 0, '2021-01-06 14:28:16', '2021-01-06 14:28:16'),
(19, 3, 'Tongue cracking & white coated', 'A fissured tongue is a benign (noncancerous) condition. It’s recognized by one or more deep or shallow cracks — called grooves, furrows, or fissures — on the top surface of your tongue', 1, 0, '2021-01-06 14:28:55', '2021-01-06 14:28:55'),
(20, 3, 'Laryngitis (Chronic)', 'Laryngitis that lasts longer than three weeks is known as chronic laryngitis. This type of laryngitis is generally caused by exposure to irritants over time', 1, 0, '2021-01-06 14:29:29', '2021-01-06 14:29:29'),
(21, 4, 'Allergy, Rhinitis (Chronic cough)', 'Allergists have particular expertise in allergic rhinitis (or hay fever) and sinus infections, which may contribute to postnasal drainage, a common cause of chronic cough', 1, 0, '2021-01-06 14:30:05', '2021-01-06 14:30:05'),
(22, 4, 'Cough, Cold, Flu, Catarrh', 'Dry cough screams flu, cough with phlegm spells cold. The flu will cause a dry cough that does not produce mucus', 1, 0, '2021-01-06 15:03:58', '2021-01-06 15:03:58'),
(23, 4, 'Sinusitis', 'Sinusitis or sinus infection is inflammation of the air cavities within the passages of the nose. Sinusitis can be caused by infection, allergies, and chemical or particulate irritation of the sinuses', 1, 0, '2021-01-06 15:04:35', '2021-01-06 15:04:35'),
(24, 4, 'Coryza (Running nose & sneezing)', 'Colds are viral infections that take hold when the body\'s resistance is lowered because of fatigue, nutritional deficiencies or stress', 1, 0, '2021-01-06 15:04:58', '2021-01-06 15:04:58'),
(25, 4, 'Bronchial Asthma (Acute & chronic) COPD', 'Chronic obstructive pulmonary disease (COPD) and bronchial asthma are the most common causes of obstructive pulmonary diseases and acute dyspnoea', 1, 0, '2021-01-06 15:05:32', '2021-01-06 15:05:32'),
(26, 4, 'Allergic Asthma', 'Allergic asthma is asthma caused by an allergic reaction. It\'s also known as allergy-induced asthma', 1, 0, '2021-01-06 15:06:12', '2021-01-06 15:06:12'),
(27, 4, 'Dust allergy', 'Dust mite allergy is an allergic reaction to tiny bugs that commonly live-in house dust. Signs of dust mite allergy include those common to hay fever, such as sneezing and runny nose', 1, 0, '2021-01-06 15:06:42', '2021-01-06 15:06:42'),
(28, 4, 'Lung Cancer (Malignancy)', 'Lung cancer begins in the cells of your lungs. Lung cancer is a type of cancer that begins in the lungs. cancer treatment depends on disease stages. Homeopathy treatment based on symptomatic as a holistic approach to cure diseases, this treatment is not a final treatment for you and take further treatment consult to your doctor', 1, 0, '2021-01-06 15:07:15', '2021-01-06 15:07:15'),
(29, 4, 'COPD due to Tobacco Smoking', 'Smoking is the leading cause of chronic obstructive pulmonary disease (COPD). Smoking is also a trigger for COPD flare-ups', 1, 0, '2021-01-06 15:07:56', '2021-01-06 15:07:56'),
(30, 4, 'Silicosis disease', 'Silicosis is an interstitial lung disease caused by breathing in tiny bits of silica, a common mineral found in many types of rock and soil.', 1, 0, '2021-01-06 15:08:26', '2021-01-06 15:08:26'),
(31, 4, 'Epistasis (nosebleed)', 'Epistaxis also called acute hemorrhage or nose bleed is a medical condition in which bleeding occurs from the nasal cavity of the nostril', 1, 0, '2021-01-06 15:09:25', '2021-01-06 15:09:25'),
(32, 4, 'Pneumonia, Chronic cough, barking cough', 'The cough begins with an initial gasp that draws air deep into the lungs. Next, the glottis snaps shut, putting a lid over the trachea, or windpipe due to bacterial infections and allergic.', 1, 0, '2021-01-06 15:09:59', '2021-01-06 15:09:59'),
(33, 4, 'Smoker’s cough, suffocative cough', 'People who smoke often develop a cough. This cough is caused by the body clearing out the chemicals that enter the airways and lungs through tobacco use', 1, 0, '2021-01-06 15:10:39', '2021-01-06 15:10:39'),
(34, 4, 'Emphysema', 'Emphysema is a lung condition that causes shortness of breath. In people with emphysema, the air sacs in the lungs (alveoli) are damaged', 1, 0, '2021-01-06 15:11:02', '2021-01-06 15:11:02'),
(35, 4, 'Pleurisy', 'Pleurisy is a condition in which the pleura — two large, thin layers of tissue that separate your lungs from your chest wall — becomes inflamed', 1, 0, '2021-01-06 15:11:29', '2021-01-06 15:11:29'),
(36, 4, 'Dyspnea', 'Dyspnea is the medical term for shortness of breath, sometimes described as “air hunger.” It is an uncomfortable feeling', 1, 0, '2021-01-06 15:11:54', '2021-01-06 15:11:54'),
(37, 4, 'Tuberculosis lungs (TB)', 'Tuberculosis (TB) is a potentially serious infectious disease that mainly affects your lungs. The bacteria that cause tuberculosis are spread from one person to another through tiny droplets released into the air via coughs and sneezes', 1, 0, '2021-01-06 15:12:32', '2021-01-06 15:12:32'),
(38, 4, 'Snoring', 'Snoring is the hoarse or harsh sound that occurs when air flows past relaxed tissues in your throat, causing the tissues to vibrate as you breathe', 1, 0, '2021-01-06 15:13:16', '2021-01-06 15:13:16'),
(39, 5, 'Esophagitis / regurgitation', 'Regurgitation is the spitting up of food from the esophagus or stomach without nausea or forceful contractions of the abdominal muscles', 1, 0, '2021-01-06 15:14:05', '2021-01-06 15:14:05'),
(40, 5, 'Esophageal ulcer/ cancer/ tumor', 'Esophageal cancer occurs when cells in the esophagus develop changes (mutations) in their DNA. The changes make cells grow and divide out of control. It is a type of Peptic Ulcer, painful. cancer treatment depends on disease stages. Homeopathy treatment based on symptomatic as a holistic approach to cure diseases, this treatment is not a final treatment for you and take further treatment consult to your doctor', 1, 0, '2021-01-06 15:15:02', '2021-01-06 15:15:02'),
(41, 5, 'Hyperacidity', 'Hyperacidity, also known as gastritis or acid reflux, is the inflammation of the stomach\'s lining that is usually caused by bacterial infection or other lifestyle habits like alcohol consumption', 1, 0, '2021-01-06 15:21:46', '2021-01-06 15:21:46'),
(42, 5, 'Gas formation', 'You make gas in two ways: when you swallow air, and when the bacteria in your large intestine help digest your food', 1, 0, '2021-01-06 15:22:47', '2021-01-06 15:22:47'),
(43, 5, 'Gastric ulcer', 'Stomach ulcers are a type of peptic ulcer disease. Peptic ulcers are any ulcers that affect both the stomach and small intestines', 1, 0, '2021-01-06 15:24:16', '2021-01-06 15:24:16'),
(44, 5, 'Duodenal ulcer', 'A duodenal ulcer is an ulcer that occurs in the lining in the part of the small intestine just beyond the stomach', 1, 0, '2021-01-06 15:24:49', '2021-01-06 15:24:49'),
(45, 5, 'Peptic ulcer', 'Peptic ulcers are sores that develop in the lining of the stomach, lower esophagus, or small intestine', 1, 0, '2021-01-06 15:25:21', '2021-01-06 15:25:21'),
(46, 5, 'Nausea', 'Nausea is a term that describes the feeling that you might vomit. People with nausea have a queasy feeling that ranges from slightly uncomfortable to agonizing, often accompanied by clammy skin and a grumbling or lurching stomach', 1, 0, '2021-01-06 15:26:11', '2021-01-06 15:26:11'),
(47, 5, 'Vomiting', 'Vomiting, along with nausea, is a symptom of an underlying disease rather than a specific illness itself. Emesis is the medical term for vomiting.', 1, 0, '2021-01-06 15:26:44', '2021-01-06 15:26:44'),
(48, 5, 'Dyspepsia', 'Dyspepsia, also known as indigestion, is a term that describes discomfort or pain in the upper abdomen. It is not a disease', 1, 0, '2021-01-06 15:27:08', '2021-01-06 15:27:08'),
(49, 5, 'Stomach (Pain Abdomen)', 'Abdominal pain can be caused by many conditions. However, the main causes are infection, abnormal growths, inflammation, obstruction (blockage), and intestinal disorders', 1, 0, '2021-01-06 15:27:32', '2021-01-06 15:27:32'),
(50, 5, 'Diarrhea', 'Diarrhea is loose, watery stools (bowel movements). You have diarrhea if you have loose stools three or more times in one day due to bacterial or food poisoning.', 1, 0, '2021-01-06 15:28:08', '2021-01-06 15:28:08'),
(51, 5, 'Dysentery', 'Dysentery is an intestinal inflammation, primarily of the colon. It can lead to mild or severe stomach cramps and severe diarrhea with mucus or blood in the feces due to infection and chronic illness.', 1, 0, '2021-01-06 15:28:49', '2021-01-06 15:28:49'),
(52, 5, 'Constipation', 'Chronic constipation is infrequent bowel movements or difficult passage of stools that persists for several weeks or longer', 1, 0, '2021-01-06 15:29:10', '2021-01-06 15:29:10'),
(53, 5, 'Piles', 'Piles are collections of tissue and vein that become inflamed and swollen. The size of piles can vary, and they are found inside or outside the anus', 1, 0, '2021-01-06 15:29:40', '2021-01-06 15:29:40'),
(54, 5, 'Anal Fistula', 'A fistula is an abnormal connection between two hollow spaces (technically, two epithelialized surfaces), such as blood vessels, intestines, or other hollow organs. An Anal Fistula is an inflamed tunnel between the skin and anus. Mostly Anal Fistulas are the result of an infection in an anal gland.', 1, 0, '2021-01-06 15:31:21', '2021-01-06 15:31:21'),
(55, 5, 'Intestinal infection', 'Small intestinal infectious diarrheas tend to cause mild to moderate symptoms, including large volume, watery diarrhea with diffuse abdominal pain or cramping', 1, 0, '2021-01-06 15:32:42', '2021-01-06 15:32:42'),
(56, 5, 'Tuberculosis/ Cancer', 'Tuberculosis results from the reactivation of latent infection with Mycobacterium tuberculosis, which currently infects one third of the world\'s population. cancer treatment depends on disease stages. Homeopathy treatment based on symptomatic as a holistic approach to cure diseases, this treatment is not a final treatment for you and take further treatment consult to your doctor', 1, 0, '2021-01-06 15:33:08', '2021-01-06 15:33:08'),
(57, 5, 'Celiac (Wheat allergy)', 'Symptoms of an allergy to wheat can include itching, hives, or anaphylaxis, a life-threatening reaction', 1, 0, '2021-01-06 15:35:03', '2021-01-06 15:35:03'),
(58, 5, 'Irritable bowel syndrome (IBS)', 'Irritable bowel syndrome (IBS) is a common disorder that affects the large intestine. Signs and symptoms include cramping, abdominal pain, bloating, gas, and diarrhea or constipation, or both', 1, 0, '2021-01-06 15:41:20', '2021-01-06 15:41:20'),
(59, 5, 'Ulcerative Colitis', 'Ulcerative colitis  is an inflammatory bowel disease (IBD) that causes long-lasting inflammation and ulcers (sores) in your digestive tract', 1, 0, '2021-01-06 15:41:58', '2021-01-06 15:41:58'),
(60, 5, 'Colitis', 'Colitis is a chronic digestive disease characterized by inflammation of the inner lining of the colon. Infection, loss of blood supply in the colon, Inflammatory Bowel Disease (IBD) and invasion of the colon wall with collagen or lymphocytic white blood cells are all possible causes of an inflamed colon.', 1, 0, '2021-01-06 15:42:48', '2021-01-06 15:42:48'),
(61, 5, 'Food Poisoning', 'Food poisoning, also called foodborne illness, is illness caused by eating contaminated food. Infectious organisms — including bacteria, viruses and parasites.', 1, 0, '2021-01-06 15:43:33', '2021-01-06 15:43:33'),
(62, 5, 'Appendicitis', 'Appendicitis is an inflammation of the appendix, a finger-shaped pouch that projects from your colon on the lower right side of your abdomen', 1, 0, '2021-01-06 15:43:55', '2021-01-06 15:43:55'),
(63, 5, 'Hernia (Inguinal)', 'An inguinal hernia occurs when tissue, such as part of the intestine, protrudes through a weak spot in the abdominal muscles', 1, 0, '2021-01-06 15:44:21', '2021-01-06 15:44:21'),
(64, 5, 'Worms', 'Intestinal worms, also known as parasitic worms, are one of the main types of intestinal parasites', 1, 0, '2021-01-06 15:46:17', '2021-01-06 15:46:17'),
(65, 6, 'Jaundice (Hepatitis A, B, C, E)', 'Viruses that primarily attack the liver are called hepatitis viruses. There are several types of hepatitis viruses including types A, B, C, D, E.', 1, 0, '2021-01-06 15:47:05', '2021-01-06 15:47:05'),
(66, 6, 'Liver cirrhosis (Alcoholic liver)', 'Alcoholic liver cirrhosis is the most advanced form of liver disease that\'s related to drinking alcohol', 1, 0, '2021-01-06 15:47:37', '2021-01-06 15:47:37'),
(67, 6, 'Gallstones', 'A hardened deposit within the fluid in the gallbladder, a small organ under the liver', 1, 0, '2021-01-06 15:48:09', '2021-01-06 15:48:09'),
(68, 6, 'Splenomegaly', 'Splenomegaly is a condition that occurs when your spleen becomes enlarged. It\'s also commonly referred to as enlarged spleen or spleen enlargement', 1, 0, '2021-01-06 15:48:34', '2021-01-06 15:48:34'),
(69, 6, 'Ascites', 'Ascites is the abnormal buildup of fluid in the abdomen. Technically, it is more than 25 ml of fluid in the peritoneal cavity', 1, 0, '2021-01-06 15:49:07', '2021-01-06 15:49:07'),
(70, 7, 'Kidney stone (Calculus)', 'A small, hard deposit that forms in the kidneys and is often painful when passed', 1, 0, '2021-01-06 15:57:10', '2021-01-06 15:57:10'),
(71, 7, 'Ureteric stone', 'Uretheral stones are kidney stones that have become stuck in one or both ureters (the tubes that carry urine from the kidneys to the bladder)', 1, 0, '2021-01-06 15:57:36', '2021-01-06 15:57:36'),
(72, 7, 'Urinary tract infection (UTI)', 'An infection in any part of the urinary system, the kidneys, bladder or urethra.', 1, 0, '2021-01-06 15:58:05', '2021-01-06 15:58:05'),
(73, 7, 'Cystitis', 'Cystitis is an inflammation of the bladder. Inflammation is where part of your body becomes irritated, red, or swollen. In most cases, the cause of cystitis is a urinary tract infection (UTI).', 1, 0, '2021-01-06 15:58:42', '2021-01-06 15:58:42'),
(74, 7, 'Prostate enlargement (BPH)', 'Age-associated prostate gland enlargement that can cause urination difficulty.', 1, 0, '2021-01-06 15:59:20', '2021-01-06 15:59:20'),
(75, 7, 'Chronic Renal Failure (CRF)', 'Chronic Renal Failure – CRF. CRF builds slowly with very few symptoms in its early stages', 1, 0, '2021-01-06 16:00:01', '2021-01-06 16:00:01'),
(76, 7, 'Polycystic Kidney', 'Polycystic kidney disease (PKD) is an inherited disorder in which clusters of cysts develop primarily within your kidneys, causing your kidneys to enlarge and lose function over time', 1, 0, '2021-01-06 16:00:42', '2021-01-06 16:00:42'),
(77, 7, 'Renal Hypertension', 'Renal hypertension, also called renovascular hypertension, is elevated blood pressure caused by kidney disease. It can usually be controlled by blood pressure drugs.', 1, 0, '2021-01-06 16:01:10', '2021-01-06 16:01:10'),
(78, 7, 'Proteinuria', 'Proteinuria is a condition characterized by the presence of greater than normal amounts of protein in the urine', 1, 0, '2021-01-06 16:01:46', '2021-01-06 16:01:46'),
(79, 7, 'Bright disease nephritis', 'Bright disease, also called glomerulonephritis or nephritis, inflammation of the structures in the kidney that produce urine: the glomeruli and the nephrons.', 1, 0, '2021-01-06 16:02:08', '2021-01-06 16:02:08'),
(80, 7, 'Polyuria, Albuminuria', 'Renal hypertension in animals is associated with polyuria, albuminuria, and sometimes edema', 1, 0, '2021-01-06 16:02:43', '2021-01-06 16:02:43'),
(81, 7, 'Urinary disease', 'Urinary disorders include cancers of the urinary tract, incontinence (inability to control urine flow), interstitial cystitis, kidney stones, kidney failure, and urinary tract infections', 1, 0, '2021-01-06 16:03:11', '2021-01-06 16:03:11'),
(82, 7, 'Hematuria', 'Hematuria is the presence of blood in a person\'s urine. The two types of hematuria are. gross hematuria—when a person can see the blood in his or her urine.', 1, 0, '2021-01-06 16:03:31', '2021-01-06 16:03:31'),
(83, 7, 'Uremia', 'Uremia is the condition of having high levels of urea in the blood. Urea is one of the primary components of urine.', 1, 0, '2021-01-06 16:04:04', '2021-01-06 16:04:04'),
(84, 7, 'Hydronephrosis', 'Hydronephrosis is a condition that typically occurs when a kidney swells due to urine failing to properly drain from the kidney to the bladder', 1, 0, '2021-01-06 16:04:24', '2021-01-06 16:04:24'),
(85, 7, 'Enuresis (Bed wetting)', 'Sometimes enuresis is also called involuntary urination. Nocturnal enuresis is involuntary urination that happens at night while sleeping, after the age when a person should be able to control his or her bladder.', 1, 0, '2021-01-06 16:05:00', '2021-01-06 16:05:00'),
(86, 8, 'B.P (High Blood Pressure)', 'Normal blood pressure is less than 120 on top and less than 80 on the bottom. Prehypertension levels are 120-140 on top and 80-90 on the bottom.', 1, 0, '2021-01-06 17:32:26', '2021-01-06 17:32:26'),
(87, 8, 'Low Blood Pressure', 'In severe cases, low blood pressure can be life-threatening. A blood pressure reading lower than 90 millimeters of mercury (mm Hg) for the top number (systolic) or 60 mm Hg for the bottom number (diastolic) is generally considered low blood pressure', 1, 0, '2021-01-06 17:33:13', '2021-01-06 17:33:13'),
(88, 8, 'Coronary arteries Blockage (Thrombosis)', 'Coronary thrombosis is the formation of a blood clot inside a blood vessel of the heart. This blood clot restricts blood flow within the heart.', 1, 0, '2021-01-06 17:33:53', '2021-01-06 17:33:53'),
(89, 8, 'High Cholesterol', 'Your body needs cholesterol to build healthy cells, but high levels of cholesterol can increase your risk of heart disease.', 1, 0, '2021-01-06 17:34:24', '2021-01-06 17:34:24'),
(90, 8, 'Weak Heart', 'When the heart muscle is weak, blood cannot be pumped efficiently enough to get oxygen to all of the cells. Sometimes the heart becomes dilated and weak.', 1, 0, '2021-01-06 17:34:50', '2021-01-06 17:34:50'),
(91, 8, 'Varicose Vein / Ulcer', 'Venous ulcers are due to abnormal vein function. People may inherit a tendency for abnormal veins. Common causes of damaged veins include blood clots, injury, ageing and obesity', 1, 0, '2021-01-06 17:35:38', '2021-01-06 17:35:38'),
(92, 8, 'Anemia', 'Anemia is a condition in which you lack enough healthy red blood cells to carry adequate oxygen to your body\'s tissues. Having anemia can make you feel tired and weak.', 1, 0, '2021-01-06 17:36:10', '2021-01-06 17:36:10'),
(93, 8, 'Water retention', 'Fluid retention or edema means that there is excessive water in the tissue of the body which causes the body to swell, especially in the extremities', 1, 0, '2021-01-06 17:36:41', '2021-01-06 17:36:41'),
(94, 8, 'Edema (Feet)', 'Swollen feet can have causes that aren\'t due to underlying disease. Examples include a sprain or strain, fluid retention from large salt intake, prolonged time on feet (standing or walking), menstruation, pregnancy or medication side effects.', 1, 0, '2021-01-06 17:37:06', '2021-01-06 17:37:06'),
(95, 8, 'Eosinophilia', 'Eosinophilia refers to a condition of having an increased number of eosinophils in the peripheral blood.', 1, 0, '2021-01-06 17:37:50', '2021-01-06 17:37:50'),
(96, 8, 'Blood cancer (Leukemia)', 'A cancer of blood-forming tissues, hindering the body\'s ability to fight infection. cancer treatment depends on disease stages. Homeopathy treatment based on symptomatic as a holistic approach to cure diseases, this treatment is not a final treatment for you and take further treatment consult to your doctor', 1, 0, '2021-01-06 17:38:21', '2021-01-06 17:38:21'),
(97, 8, 'Palpitations', 'A sensation that the heart is racing, pounding, fluttering or skipping a beat, often bothersome, but hardly ever a sign of heart disease.', 1, 0, '2021-01-06 17:39:04', '2021-01-06 17:39:04'),
(98, 8, 'Tachycardia', 'Tachycardia is a condition that makes your heart beat more than 100 times per minute. There are three types of it: Supraventricular.', 1, 0, '2021-01-06 17:39:25', '2021-01-06 17:39:25'),
(99, 8, 'Bradycardia', 'Bradycardia is a heart rate that\'s too slow. What\'s considered too slow can depend on your age and physical condition.', 1, 0, '2021-01-06 17:39:46', '2021-01-06 17:39:46'),
(100, 8, 'Lipid Profile (High cholesterol)', 'If your doctor says you have a lipid disorder, that means you have high blood levels of low-density lipoprotein (LDL) cholesterol, and fats called triglycerides, or both.', 1, 0, '2021-01-06 17:40:20', '2021-01-06 17:40:20'),
(101, 8, 'Atherosclerosis (Blockage arteries/veins)', 'Atherosclerosis can occur in any artery – but not in the veins, the vessels that carry blood back to the heart.', 1, 0, '2021-01-06 17:41:09', '2021-01-06 17:41:09'),
(102, 8, 'Rheumatic heart disease (RHD)', 'A disease that can result from inadequately treated strep throat or scarlet fever.', 1, 0, '2021-01-06 17:41:30', '2021-01-06 17:41:30'),
(103, 8, 'Hypoglycemia', 'Hypoglycemia is a condition in which your blood sugar (glucose) level is lower than normal.', 1, 0, '2021-01-06 17:41:54', '2021-01-06 17:41:54'),
(104, 8, 'Gangrene', 'Gangrene refers to the death of body tissue due to either a lack of blood flow or a serious bacterial infection.', 1, 0, '2021-01-06 17:42:14', '2021-01-06 17:42:14'),
(105, 9, 'Headache', 'A headache can be a sign of stress or emotional distress, or it can result from a medical disorder, such as migraine or high blood pressure, anxiety, or depression.', 1, 0, '2021-01-06 17:43:02', '2021-01-06 17:43:02'),
(106, 9, 'Migraine', 'Migraine is a neurological condition that can cause multiple symptoms. It\'s frequently characterized by intense, debilitating headaches.', 1, 0, '2021-01-06 17:43:26', '2021-01-06 17:43:26'),
(107, 9, 'Trigeminal Neuralgia', 'Trigeminal neuralgia is sudden, severe facial pain. It\'s often described as a sharp shooting pain or like having an electric shock in the jaw, teeth or gums.', 1, 0, '2021-01-06 17:44:20', '2021-01-06 17:44:20'),
(108, 9, 'Anxiety', 'Anxiety is your body\'s natural response to stress. It\'s a feeling of fear or apprehension about what\'s to come.', 1, 0, '2021-01-06 17:44:43', '2021-01-06 17:44:43'),
(109, 9, 'Insanity', 'Insanity. n. mental illness of such a severe nature that a person cannot distinguish fantasy from reality, cannot conduct her/his affairs due to psychosis, or is subject to uncontrollable impulsive behavior.', 1, 0, '2021-01-06 17:45:07', '2021-01-06 17:45:07'),
(110, 9, 'Melancholia', 'Biological psychiatrists understand melancholia as a severe mood disorder associated with dysfunctions along the body’s hypothalamic-pituitary-adrenal axis.', 1, 0, '2021-01-06 17:45:35', '2021-01-06 17:45:35'),
(111, 9, 'Epilepsy', 'A disorder in which nerve cell activity in the brain is disturbed, causing seizures.', 1, 0, '2021-01-06 17:46:01', '2021-01-06 17:46:01'),
(112, 9, 'Fits (Seizures)', 'A seizure is a sudden, uncontrolled electrical disturbance in the brain. It can cause changes in your behavior, movements or feelings, and in levels of consciousness.', 1, 0, '2021-01-06 17:51:45', '2021-01-06 17:51:45'),
(113, 9, 'Depression', 'A mental health disorder characterised by persistently depressed mood or loss of interest in activities, causing significant impairment in daily life.', 1, 0, '2021-01-06 17:52:09', '2021-01-06 17:52:09'),
(115, 9, 'Impulse', 'Impulse-control disorder (ICD) is a class of psychiatric disorders characterized by impulsivity – failure to resist a temptation, an urge, or an impulse; or having the inability to not speak on a thought.', 1, 0, '2021-01-06 17:52:59', '2021-01-06 17:52:59'),
(116, 9, 'Neurasthenia', 'A condition that is characterized especially by physical and mental exhaustion usually with accompanying symptoms (such as headache and irritability), is of unknown cause but is often associated with depression or emotional stress.', 1, 0, '2021-01-06 17:53:41', '2021-01-06 17:53:41'),
(117, 9, 'Mental disorders', 'There are many different mental disorders, with different presentations. They are generally characterized by a combination of abnormal thoughts, perceptions, emotions, behaviour and relationships with others', 1, 0, '2021-01-06 17:54:11', '2021-01-06 17:54:11'),
(118, 9, 'Shock (Apoplexy)', 'apoplectic shock. An obsolete term for the depression of neurologic function which follows cerebral haemorrhage (stroke); it is little used in the working medical parlance', 1, 0, '2021-01-06 17:55:11', '2021-01-06 17:55:11'),
(119, 9, 'Schizophrenia', 'Schizophrenia is a serious mental disorder in which people interpret reality abnormally. Schizophrenia may result in some combination of hallucinations, delusions, and extremely disordered thinking and behavior that impairs daily functioning, and can be disabling', 1, 0, '2021-01-06 17:55:37', '2021-01-06 17:55:37'),
(120, 9, 'Brain Tumor (Benign/ Malignant)', 'Benign brain tumors are noncancerous. Malignant primary brain tumors are cancers that originate in the brain, typically grow faster than benign tumors, and aggressively invade surrounding tissue. cancer treatment depends on disease stages. Homeopathy treatment based on symptomatic as a holistic approach to cure diseases, this treatment is not a final treatment for you and take further treatment consult to your doctor', 1, 0, '2021-01-06 18:07:07', '2021-01-06 18:07:07'),
(121, 9, 'Lack of concentration', 'Difficulty concentrating is a normal and periodic occurrence for most people. Tiredness and emotional stress can cause concentration problems in most people.', 1, 0, '2021-01-06 18:07:34', '2021-01-06 18:07:34'),
(122, 9, 'Somatic disorders', 'Somatic symptom disorder (SSD) occurs when a person feels extreme, exaggerated anxiety about physical symptoms. The person has such intense thoughts, feelings, and behaviors related to the symptoms, that they feel they cannot do some of the activities of daily life.', 1, 0, '2021-01-06 18:07:59', '2021-01-06 18:07:59'),
(123, 9, 'Hyperactive', 'A chronic condition including attention difficulty, hyperactivity and impulsiveness.', 1, 0, '2021-01-06 18:08:23', '2021-01-06 18:08:23'),
(124, 9, 'Phobia', 'A phobia is a type of anxiety disorder defined by a persistent and excessive fear of an object or situation. The phobia typically results in a rapid onset of fear and is present for more than six months.', 1, 0, '2021-01-06 18:08:53', '2021-01-06 18:08:53'),
(125, 9, 'Mania', 'Mania, also known as manic syndrome, is a state of abnormally elevated arousal, affect, and energy level, or \"a state of heightened overall activation with enhanced affective expression together with lability of affect.\"', 1, 0, '2021-01-06 18:09:47', '2021-01-06 18:09:47'),
(126, 9, 'Paralysis (Hemiplegia/ Paraplegia)', 'There are many different causes of paralysis—and each one may result in a different kind of paralysis, such as quadriplegia (paralysis of arms and legs), paraplegia (being paralyzed from the waist down), monoplegia (paralysis in one limb), or hemiplegia (being paralyzed on one side of the body).', 1, 0, '2021-01-06 18:10:22', '2021-01-06 18:10:22'),
(127, 9, 'Cerebral Palsy', 'Cerebral palsy is due to abnormal brain development, often before birth.', 1, 0, '2021-01-06 18:10:44', '2021-01-06 18:10:44'),
(128, 9, 'Nervous Breakdown', 'A nervous or mental breakdown is a term used to describe a period of intense mental distress. During this period, you’re unable to function in your everyday life.', 1, 0, '2021-01-06 18:11:08', '2021-01-06 18:11:08'),
(129, 9, 'Weakness', 'Asthenia, also known as weakness, is the feeling of body fatigue or tiredness. A person experiencing weakness may not be able to move a certain part of their body properly.', 1, 0, '2021-01-06 18:11:31', '2021-01-06 18:11:31'),
(130, 9, 'Brainfag', 'Brain fag (uncountable) A condition to which male high school and college students are prone consisting of difficulty in concentrating, mild forgetfulness, and difficulty in maintaining a train of thought, arising from too much thinking.', 1, 0, '2021-01-06 18:12:04', '2021-01-06 18:12:04'),
(131, 9, 'Memory problem', 'It\'s the stuff movies are made of: After a blow to the head, a person wanders aimlessly, unable to remember who he is or where he came from. While such sudden, profound loss of memory is rare, memory loss is a problem that affects most people, to a degree', 1, 0, '2021-01-06 18:12:51', '2021-01-06 18:12:51'),
(132, 9, 'Hemophilia', 'Hemophilia is a rare disorder in which your blood doesn\'t clot normally because it lacks sufficient blood-clotting proteins (clotting factors). If you have hemophilia, you may bleed for a longer time after an injury than you would if your blood clotted normally.', 1, 0, '2021-01-06 18:13:41', '2021-01-06 18:13:41'),
(133, 9, 'Neuralgia', 'Neuralgia is a stabbing, burning, and often severe pain due to an irritated or damaged nerve. The nerve may be anywhere in the body, and the damage may be caused by several things', 1, 0, '2021-01-06 18:14:11', '2021-01-06 18:14:11'),
(134, 9, 'Parkinson disease', 'Parkinson\'s Disease. Parkinson\'s disease is a brain disorder that leads to shaking, stiffness, and difficulty with walking, balance, and coordination.', 1, 0, '2021-01-06 18:14:33', '2021-01-06 18:14:33'),
(135, 9, 'Forgetfulness', 'Forgetfulness can be a normal part of aging. As people get older, changes occur in all parts of the body, including the brain.', 1, 0, '2021-01-06 18:14:54', '2021-01-06 18:14:54'),
(136, 9, 'Dementia', 'Dementia is a collective term used to describe various symptoms of cognitive decline, such as forgetfulness.', 1, 0, '2021-01-06 18:15:24', '2021-01-06 18:15:24'),
(137, 9, 'Mental Shock', 'Psychological shock is when you experience a surge of strong emotions and a corresponding physical reaction, in response to a (typically unexpected) stressful event.', 1, 0, '2021-01-06 18:15:49', '2021-01-06 18:15:49'),
(138, 10, 'Osteoarthritis', 'Osteoarthritis is the most common form of arthritis, affecting millions of people worldwide. It occurs when the protective cartilage that cushions the ends of your bones wears down over time. Mostly effected knee joints', 1, 0, '2021-01-08 15:58:35', '2021-01-08 15:58:35'),
(139, 10, 'Osteoporosis', 'Osteoporosis is a bone disease that occurs when the body loses too much bone calcium and vitamin D3. As a result, bones become weak and may break from a fall', 1, 0, '2021-01-08 15:59:07', '2021-01-08 15:59:07'),
(140, 10, 'AVN', 'Avascular necrosis (AVN) is the death of bone tissue due to a loss of blood supply. You might also hear it called osteonecrosis, aseptic necrosis, or ischemic bone necrosis.', 1, 0, '2021-01-08 15:59:34', '2021-01-08 15:59:34'),
(141, 10, 'Rheumatoid Arthritis', 'Inflammation of one or more joints, causing pain and stiffness that can worsen with age.', 1, 0, '2021-01-08 15:59:58', '2021-01-08 15:59:58'),
(142, 10, 'Low Back pain', 'By far the most common cause of lower back pain, mechanical pain (axial pain) is pain primarily from the muscles, ligaments, joints (facet joints, sacroiliac joints), or bones in and around the spine.', 1, 0, '2021-01-08 16:00:18', '2021-01-08 16:00:18'),
(143, 10, 'Joints pain', 'Pain is also a feature of joint inflammation (arthritis, such as rheumatoid arthritis and osteoarthritis) and infection, and extremely rarely it can be a cause of cancer of the joint.', 1, 0, '2021-01-08 16:01:16', '2021-01-08 16:01:16'),
(144, 10, 'Muscular pain', 'Muscle pain can have causes that aren\'t due to underlying disease. Examples include exercise, prolonged sitting or lying down, doing a new physical activity for the first time, sprains or strains.', 1, 0, '2021-01-08 16:01:38', '2021-01-08 16:01:38'),
(145, 10, 'Slip disc', 'A condition which refers to a problem with a rubbery disc between the spinal bones.', 1, 0, '2021-01-08 16:02:05', '2021-01-08 16:02:05'),
(146, 10, 'Sciatica', 'Sciatica refers to pain that radiates along the path of the sciatic nerve, which branches from your lower back through your hips and buttocks and down each leg.', 1, 0, '2021-01-08 16:02:33', '2021-01-08 16:02:33'),
(147, 10, 'Sports Injury', 'Sports injuries occur during exercise or while participating in a sport. Children are particularly at risk for these types of injuries, but adults can get them, too.', 1, 0, '2021-01-08 16:02:51', '2021-01-08 16:02:51'),
(148, 10, 'Cervical spondylitis', 'Cervical spondylosis is a general term for age-related wear and tear affecting the spinal disks in your neck.', 1, 0, '2021-01-08 16:03:19', '2021-01-08 16:03:19'),
(149, 10, 'Frozen shoulder', 'Frozen shoulder is a condition that affects your shoulder joint. It usually involves pain and stiffness that develops gradually, gets worse and then finally goes away.', 1, 0, '2021-01-08 16:03:40', '2021-01-08 16:03:40'),
(150, 10, 'Tennis elbow', 'Tennis elbow (lateral epicondylitis) is a painful condition that occurs when tendons in your elbow are overloaded, usually by repetitive motions of the wrist and arm.', 1, 0, '2021-01-08 16:03:58', '2021-01-08 16:03:58'),
(151, 10, 'Muscle cramps', 'A muscle cramp is a strong, painful contraction or tightening of a muscle that comes on suddenly and lasts from a few seconds to several minutes.', 1, 0, '2021-01-08 16:04:19', '2021-01-08 16:04:19'),
(152, 10, 'Vitamin D3, B12 deficiency', 'Vitamin D3 deficiency symptoms and signs include unexplained fatigue, muscle weakness, deformities in soft bones, cognitive impairment, cardiovascular diseases, high blood pressure, cancer, and severe asthma in children.', 1, 0, '2021-01-08 16:04:38', '2021-01-08 16:04:38'),
(153, 10, 'Gout (Arthritis)', 'Gout is a form of arthritis caused by excess uric acid in the bloodstream. The symptoms of gout are due to the formation of uric acid crystals in the joints and the body\'s response to them. Gout most classically affects the joint in the base of the big toe.', 1, 0, '2021-01-08 16:05:14', '2021-01-08 16:05:14'),
(154, 10, 'Multiple sclerosis', 'A disease in which the immune system eats away at the protective covering of nerves', 1, 0, '2021-01-08 16:05:39', '2021-01-08 16:05:39'),
(155, 10, 'Facial Palsy', 'Sudden weakness in the muscles on one half of the face. Bell\'s palsy may be a reaction to a viral infection. It rarely occurs more than once.', 1, 0, '2021-01-08 16:06:11', '2021-01-08 16:06:11'),
(156, 10, 'Bell Palsy', 'Sudden weakness in the muscles on one half of the face. Bell\'s palsy may be a reaction to a viral infection. It rarely occurs more than once.', 1, 0, '2021-01-08 16:06:34', '2021-01-08 16:06:34'),
(157, 11, 'Eczema', 'Eczema is a condition where patches of skin become inflamed, itchy, red, cracked, and rough. Blisters may sometimes occur.', 1, 0, '2021-01-08 16:07:12', '2021-01-08 16:07:12'),
(158, 11, 'Psoriasis', 'Psoriasis is a skin disorder that causes skin cells to multiply up to 10 times faster than normal. It is autoimmune disease.', 1, 0, '2021-01-08 16:07:37', '2021-01-08 16:07:37'),
(159, 11, 'Leucoderma', 'Vitiligo also called as \'leucoderma\' is an autoimmune disorder wherein the immune system of the body attacks the healthy cells and, in turn, starts affecting the body.', 1, 0, '2021-01-08 16:08:01', '2021-01-08 16:08:01'),
(160, 11, 'Vitiligo', 'Vitiligo is a condition in which the skin loses its pigment cells (melanocytes). This can result in discolored patches in different areas of the body, including the skin, hair and mucous membranes. Vitiligo is a disease that causes loss of skin color in patches.', 1, 0, '2021-01-08 16:08:43', '2021-01-08 16:08:43'),
(161, 11, 'White spots', NULL, 1, 0, '2021-01-08 16:09:01', '2021-01-08 16:12:14'),
(162, 11, 'Atopic dermatitis', 'Atopic dermatitis (eczema) is a condition that makes your skin red and itchy. It\'s common in children but can occur at any age.', 1, 0, '2021-01-08 16:12:37', '2021-01-08 16:12:37'),
(163, 11, 'Sun allergy', 'A sun allergy is a condition that happens when the immune system reacts to sunlight. The immune system treats sun-altered skin as foreign cells, leading to the reactions.', 1, 0, '2021-01-08 16:13:00', '2021-01-08 16:13:00'),
(164, 11, 'Chemical allergy', 'Chemical allergy describes the adverse health effects that may result when exposure to a chemical elicits an immune response.', 1, 0, '2021-01-08 16:13:20', '2021-01-08 16:13:20'),
(165, 11, 'Burns & scalds', 'A burn is caused by dry heat – by an iron or fire, for example. A scald is caused by something wet, such as hot water or steam.', 1, 0, '2021-01-08 16:14:05', '2021-01-08 16:14:05'),
(166, 11, 'Ornament allergy', 'Jewellery allergy is a common cause of contact allergic dermatitis. Most jewellery allergy is caused by the metal nickel which is used in the manufacture of precious metal alloys.', 1, 0, '2021-01-08 16:14:37', '2021-01-08 16:14:37'),
(167, 11, 'Garment allergy', 'If a wool sweater makes you itch, or if polyester pants give you a rash, you may have what\'s called textile or clothing dermatitis. It\'s a form of contact dermatitis. Your skin is reacting to the fibers in your clothes, or to the dyes, resins, and other chemicals used to treat what you wear.', 1, 0, '2021-01-08 16:15:03', '2021-01-08 16:15:03'),
(168, 11, 'Ringworms (Fungal infection)', 'Ringworm, also known as dermatophytosis, dermatophyte infection, or tinea, is a fungal infection of the skin. “Ringworm” is a misnomer, since a fungus, not a worm, causes the infection.', 1, 0, '2021-01-08 16:15:28', '2021-01-08 16:15:28'),
(169, 11, 'Genital fungal infection', 'A vaginal yeast infection is a fungal infection that causes irritation, discharge and intense itchiness of the vagina and the vulva — the tissues at the vaginal opening.', 1, 0, '2021-01-08 16:16:15', '2021-01-08 16:16:15'),
(170, 11, 'Warts all types on body', 'A small, hard, benign growth on the skin caused by virus (human papilloma virus)', 1, 0, '2021-01-08 16:16:38', '2021-01-08 16:16:38'),
(171, 11, 'Corns/Callus sole of feet', 'Corns and calluses are thick hard layers of skin that develop when your skin tries to protest itself against friction and pressure.', 1, 0, '2021-01-08 16:16:59', '2021-01-08 16:16:59'),
(172, 11, 'Keloid', 'Keloids are a type of raised scar. They occur where the skin has healed after an injury. They can grow to be much larger than the original injury that caused the scar.', 1, 0, '2021-01-08 16:17:34', '2021-01-08 16:17:34'),
(173, 11, 'Heels cracking', 'Cracked heels also referred to as heel fissures are a common foot condition which can cause discomfort or painful.', 1, 0, '2021-01-08 16:17:54', '2021-01-08 16:17:54'),
(174, 11, 'Plant / Flower allergy', 'A plant allergy, also called allergic rhinitis or hay fever, is an allergic reaction caused by plants and their pollen.', 1, 0, '2021-01-08 16:18:24', '2021-01-08 16:18:24'),
(175, 11, 'Wheat / Celiac allergy', 'Wheat allergy sometimes is confused with celiac disease, but these conditions differ. Wheat allergy occurs when your body produces antibodies to proteins found in wheat.', 1, 0, '2021-01-08 16:18:50', '2021-01-08 16:18:50'),
(176, 11, 'Urticarria', 'Urticaria, also known as hives, is an outbreak of swollen, pale red bumps or plaques (wheals) on the skin that appear suddenly -- either as a result of the body\'s reaction to certain allergens, or for unknown reasons.', 1, 0, '2021-01-08 16:19:15', '2021-01-08 16:19:15'),
(177, 11, 'Blisters', 'Blisters can have causes that aren\'t due to underlying disease. Examples include burns, friction injuries or trauma.', 1, 0, '2021-01-08 16:19:40', '2021-01-08 16:19:40'),
(178, 11, 'Melasma', 'Melasma is a common skin problem. The condition causes dark, discolored patches on your skin. It\'s also called chloasma, or the “mask of pregnancy,” when it occurs in pregnant women. The condition is much more common in women than men, though men can get it too.', 1, 0, '2021-01-08 16:20:01', '2021-01-08 16:20:01'),
(179, 11, 'Blackheads (face)', 'Blackheads are small bumps that appear on your skin due to clogged hair follicles. These bumps are called blackheads because the surface looks dark or black.', 1, 0, '2021-01-08 16:25:15', '2021-01-08 16:25:15'),
(180, 11, 'Pimples', 'A pimple is a small pustule or papule. Pimples develop when sebaceous glands, or oil glands, become clogged and infected, leading to swollen, red lesions filled with pus. Also known as spots or zits, pimples are a part of acne.', 1, 0, '2021-01-08 16:25:39', '2021-01-08 16:25:39'),
(181, 11, 'Acne Vulgaris', 'Acne vulgaris is the formation of comedones, pustule, nodules, cysts as a result of inflammation of pilosebaceous units (hair follicals and sebaceous gland) are develop on face, upper trunk mostly adults.', 1, 0, '2021-01-08 16:25:57', '2021-01-08 16:25:57'),
(182, 11, 'Dark circle under eyes', 'Oversleeping, extreme fatigue, or just staying up a few hours past your normal bedtime can cause dark circles to form under your eyes. Sleep deprivation can cause your skin to become dull and pale, allowing for dark tissues and blood vessels beneath your skin to show.', 1, 0, '2021-01-08 16:26:16', '2021-01-08 16:26:16'),
(183, 11, 'Moth spots face', 'Blemishes on face called moth are very annoying particularly to ladies of light complication as the discolored spots on skins how more strongly on face.', 1, 0, '2021-01-08 16:26:43', '2021-01-08 16:26:43'),
(184, 11, 'Chilblains', 'Chilblains are the painful inflammation of small blood vessels in your skin that occur in response to repeated exposure to cold but not freezing air. Also known as pernio, chilblains can cause itching, red patches, swelling and blistering on your hands and feet.', 1, 0, '2021-01-08 16:27:02', '2021-01-08 16:27:02'),
(185, 11, 'Chapped hands', 'Avoid excessive sun exposure or exposure to extreme cold or wind. Avoid washing hands with hot water. Limit hand washing as much as possible while maintaining good hygiene. Try to keep the air in your home humid. Use mild soaps or non-soap cleansers.', 1, 0, '2021-01-08 16:28:55', '2021-01-08 16:28:55'),
(186, 11, 'Lentigo', 'A lentigo is a small pigmented spot on the skin with a clearly defined edge, surrounded by normal-appearing skin. It is a harmless (benign) hyperplasia of melanocytes which is linear in its spread.', 1, 0, '2021-01-08 16:30:04', '2021-01-08 16:30:04'),
(187, 11, 'Boils', 'A boil is a skin infection that starts in a hair follicle or oil gland. At first, the skin turns red in the area of the infection, and a tender lump develops. After four to seven days, the lump starts turning white as pus collects under the skin.', 1, 0, '2021-01-08 16:30:25', '2021-01-08 16:30:25'),
(188, 11, 'Carbuncles', 'A carbuncle is a red, swollen, and painful cluster of boils that are connected to each other under the skin. A boil (or furuncle) is an infection of a hair follicle that has a small collection of pus (called an abscess) under the skin.', 1, 0, '2021-01-08 16:31:50', '2021-01-08 16:31:50'),
(189, 11, 'Abscess', 'An abscess is a collection of pus that has built up within the tissue of the body. Signs and symptoms of abscesses include redness, pain, warmth, and swelling. The swelling may feel fluid-filled when pressed. The area of redness often extends beyond the swelling.', 1, 0, '2021-01-08 16:32:48', '2021-01-08 16:32:48'),
(190, 11, 'Follicullitis', 'Folliculitis is a common skin condition in which hair follicles become inflamed. It\'s usually caused by a bacterial or fungal infection. At first it may look like small red bumps or white-headed pimples around hair follicles — the tiny pockets from which each hair grows.', 1, 0, '2021-01-08 16:34:07', '2021-01-08 16:34:07'),
(191, 11, 'Herpes Zoster', 'Herpes zoster is viral infection that occurs with reactivation of the varicella-zoster virus. It is usually a painful but self-limited dermatomal rash. Symptoms typically start with pain along the affected dermatome, which is followed in 2-3 days by a vesicular eruption.', 1, 0, '2021-01-08 16:34:27', '2021-01-08 16:34:27'),
(192, 11, 'Chicken pox', 'Chickenpox is highly contagious to those who haven\'t had the disease or been vaccinated against it.The most characteristic symptom is an itchy, blister-like rash on the skin.', 1, 0, '2021-01-08 16:36:06', '2021-01-08 16:36:06'),
(193, 11, 'Measles', 'Measles is a highly contagious, serious disease caused by a virus. Before the introduction of measles vaccine in 1963 and widespread vaccination, major epidemics occurred approximately every 2–3 years and measles caused an estimated 2.6 million deaths each year.', 1, 0, '2021-01-08 16:37:36', '2021-01-08 16:37:36'),
(194, 11, 'Bed sores', 'Bedsores are ulcers that happen on areas of the skin that are under pressure from lying in bed, sitting in a wheelchair, or wearing a cast for a prolonged time.', 1, 0, '2021-01-08 16:40:25', '2021-01-08 16:40:25'),
(195, 11, 'Hives', 'Urticaria, also known as hives, is an outbreak of swollen, pale red bumps or plaques (wheals) on the skin that appear suddenly -- either as a result of the body\'s reaction to certain allergens, or for unknown reasons. Hives usually cause itching, but may also burn or sting.', 1, 0, '2021-01-08 16:40:43', '2021-01-08 16:40:43');
INSERT INTO `homeo_diseases` (`id`, `diseases_categories_id`, `title`, `description`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(196, 11, 'Drugs allergy', 'A drug allergy is the abnormal reaction of your immune system to a medication. Any medication — over-the-counter, prescription or herbal — is capable of inducing a drug allergy. However, a drug allergy is more likely with certain medications.', 1, 0, '2021-01-08 16:42:22', '2021-01-08 16:42:22'),
(197, 11, 'Cysts (Benigns)', 'A cyst is a sac-like pocket of membranous tissue that contains fluid, air, or other substances. Cysts can grow almost anywhere in your body or under your skin.', 1, 0, '2021-01-08 16:43:04', '2021-01-08 16:43:04'),
(198, 11, 'Filaria (elephantitis)', 'Filariasis is a parasitic disease caused by an infection with roundworms of the Filarioidea type. These are spread by blood-feeding insects such as black flies and mosquitoes. They belong to the group of diseases called helminthiases', 1, 0, '2021-01-08 16:43:23', '2021-01-08 16:43:23'),
(199, 11, 'Impetigo', 'Impetigo is a common and highly contagious skin infection that mainly affects infants and children. Impetigo usually appears as red sores on the face, especially around a child\'s nose and mouth, and on hands and feet.', 1, 0, '2021-01-08 16:43:47', '2021-01-08 16:43:47'),
(200, 11, 'Barbers Itch', 'Barber\'s itch is a staph infection of the hair follicles in the beard area, usually the upper lip. Shaving makes it worse. Tinea barbae is similar to barber\'s itch, but the infection is caused by a fungus. Pseudofolliculitis barbae is a disorder that occurs mainly in African American men.', 1, 0, '2021-01-08 16:44:08', '2021-01-08 16:44:08'),
(201, 11, 'Rosacea', 'Rosacea is a common skin condition that causes redness and visible blood vessels in your face. It may also produce small, red, pus-filled bumps. These signs and symptoms may flare up for weeks to months and then go away for a while.', 1, 0, '2021-01-08 16:44:53', '2021-01-08 16:44:53'),
(202, 11, 'Erythma', 'Erythema (from the Greek erythros, meaning red) is redness of the skin or mucous membranes, caused by hyperemia (increased blood flow) in superficial capillaries. It occurs with any skin injury, infection, or inflammation.', 1, 0, '2021-01-08 16:45:35', '2021-01-08 16:45:35'),
(203, 11, 'Lichen (Prickly heat)', 'Prickly heat is a skin rash caused by sweat trapped in the skin. Normally, sweat travels to the surface of the skin through tiny ducts. If the ducts become narrowed or clogged, the sweat is trapped in the skin. This can cause redness, itching, and small blisters.', 1, 0, '2021-01-08 16:46:08', '2021-01-08 16:46:08'),
(204, 11, 'Cellulites', 'Cellulite is the dimpled-looking skin that commonly occurs in the thigh region. It forms when fatty tissue deep in the skin pushes up against connective tissue. It\'s estimated that more than 85 percent of all women 21 years and older have cellulite. It\'s not as common in men.', 1, 0, '2021-01-08 16:46:30', '2021-01-08 16:46:30'),
(205, 11, 'Scabies', 'Scabies is a skin infestation caused by a mite known as the Sarcoptesscabiei. Untreated, these microscopic mites can live on your skin for months. They reproduce on the surface of your skin and then burrow into it and lay eggs. This causes an itchy, red rash to form on the skin.', 1, 0, '2021-01-08 16:46:52', '2021-01-08 16:46:52'),
(206, 11, 'Hyper Pigmentation', 'Hyperpigmentation is a common, usually harmless condition in which patches of skin become darker in color than the normal surrounding skin. This darkening occurs when an excess of melanin, the brown pigment that produces normal skin color, forms deposits in the skin.', 1, 0, '2021-01-08 16:47:14', '2021-01-08 16:47:14'),
(207, 12, 'Hair falling', 'Perhaps one of the most common hormone-related causes for hair loss is a thyroid problem.', 1, 0, '2021-01-08 16:47:47', '2021-01-08 16:47:47'),
(208, 12, 'Premature hair loss & thinning', 'This is known as premature male pattern baldness and starts out with receding hairline and thinning scalp.', 1, 0, '2021-01-08 16:48:20', '2021-01-08 16:48:20'),
(209, 12, 'Dandruff scalp', 'Dandruff and dry scalp have the same main symptoms, which are falling flakes and an itchy scalp, but they are two different conditions.', 1, 0, '2021-01-08 16:48:43', '2021-01-08 16:48:43'),
(210, 12, 'Crust scalp with Itching', 'Itching can have causes that aren\'t due to underlying disease.', 1, 0, '2021-01-08 16:49:10', '2021-01-08 16:49:10'),
(211, 12, 'Alopecia areata', 'Sudden hair loss that starts with one or more circular bald patches that may overlap. Due to fungal infection.', 1, 0, '2021-01-08 16:49:32', '2021-01-08 16:49:32'),
(212, 12, 'Fungal infection scalp', 'Ringworm of the scalp (tinea capitis) is a fungal infection of the scalp and hair shafts.', 1, 0, '2021-01-08 16:49:57', '2021-01-08 16:49:57'),
(213, 12, 'Nails Brittles', 'Soft and brittle nails occur when the nails have too much moisture. This can happen as a result of using too much moisturizer on the hands. It could also be the result of using harsh chemicals such as acetone to remove nail polish.', 1, 0, '2021-01-08 16:50:25', '2021-01-08 16:50:25'),
(214, 12, 'Nail fungal infection', 'A fungal nail infection, also known as onychomycosis or tinea unguium, happens when a fungus that\'s normally in your fingernails or toenails overgrows.', 1, 0, '2021-01-08 16:50:44', '2021-01-08 16:50:44'),
(215, 12, 'Baldness', 'Baldness is hair loss, or absence of hair. It\'s also called alopecia. Baldness is usually most noticeable on the scalp, but it can happen anywhere on the body where hair grows.', 1, 0, '2021-01-08 16:51:02', '2021-01-08 16:51:02'),
(216, 13, 'Menstruation disorders', 'Bleeding from the uterus that occurs in-between periods, occurs every few weeks, or is painful.', 1, 0, '2021-01-08 16:51:34', '2021-01-08 16:51:34'),
(217, 13, 'Leucorrhea', 'Leukorrhea or (leucorrhoea British English) is a thick, whitish or yellowish vaginal discharge.', 1, 0, '2021-01-08 16:53:59', '2021-01-08 16:53:59'),
(218, 13, 'Amenorrhea', 'Amenorrhea is the absence of menstruation — one or more missed menstrual periods. Women who have missed at least three menstrual periods in a row have amenorrhea, as do girls who haven\'t begun menstruation by age 15.', 1, 0, '2021-01-08 16:54:35', '2021-01-08 16:54:35'),
(219, 13, 'Perimenopause syndrome', 'Perimenopause means \"around menopause\" and refers to the time during which your body makes the natural transition to menopause, marking the end of the reproductive years.', 1, 0, '2021-01-08 16:55:31', '2021-01-08 16:55:31'),
(220, 13, 'Postmenopausal syndrome (PMS)', 'The time of a woman\'s life following menopause is called postmenopause. During this time, many of the bothersome symptoms a woman may have experienced before menopause gradually decrease.', 1, 0, '2021-01-08 16:55:58', '2021-01-08 16:55:58'),
(221, 13, 'Climacteric age problems', 'Problems creates after menopause.', 1, 0, '2021-01-08 16:57:35', '2021-01-08 16:57:35'),
(222, 13, 'PCOD (Polycystic ovarian disease)', 'A hormonal disorder causing enlarged ovaries with small cysts on the outer edges.', 1, 0, '2021-01-08 16:57:57', '2021-01-08 16:57:57'),
(223, 13, 'Uterus fibroids', 'The cause of fibroids isn\'t well understood. Risk factors include a family history of fibroids, obesity or early onset of puberty. cancer treatment depends on disease stages. Homeopathy treatment based on symptomatic as a holistic approach to cure diseases, this treatment is not a final treatment for you and take further treatment consult to your doctor', 1, 0, '2021-01-08 16:58:38', '2021-01-08 16:58:38'),
(224, 13, 'Infertility', 'Infertility means not being able to become pregnant after a year of trying. If a woman can get pregnant but keeps having miscarriages or stillbirths, that\'s also called infertility. Infertility is fairly common. After one year of having unprotected sex, about 15 percent of couples are unable to get pregnant.', 1, 0, '2021-01-08 16:58:57', '2021-01-08 16:58:57'),
(225, 13, 'Sterility', 'Sterility is the physiological inability to effect sexual reproduction in a living thing, members of whose kind have been produced sexually. Sterility has a wide range of causes.', 1, 0, '2021-01-08 16:59:16', '2021-01-08 16:59:16'),
(226, 13, 'Urinary infection (UTI)', 'A urinary tract infection (UTI) is an infection from microbes. These are organisms that are too small to be seen without a microscope. Most UTIs are caused by bacteria, but some are caused by fungi and in rare cases by viruses. UTIs are among the most common infections in humans.', 1, 0, '2021-01-08 17:00:00', '2021-01-08 17:00:00'),
(227, 13, 'Vaginitis', 'Vaginitis is an inflammation of the vagina that can result in discharge, itching and pain. The cause is usually a change in the normal balance of vaginal bacteria or an infection. Reduced estrogen levels after menopause and some skin disorders can also cause vaginitis.', 1, 0, '2021-01-08 17:00:24', '2021-01-08 17:00:24'),
(228, 13, 'Genital warts', 'Genital warts are soft growths that appear on the genitals. They can cause pain, discomfort, and itching. Genital warts a sexually transmitted infection (STI) caused by certain low-risk strains of the human papillomavirus (HPV).', 1, 0, '2021-01-08 17:00:40', '2021-01-08 17:00:40'),
(229, 13, 'Vaginal Fungal infection (Genital)', 'A vaginal yeast infection is a fungal infection that causes irritation, discharge and intense itchiness of the vagina and the vulva — the tissues at the vaginal opening. Also called vaginal candidiasis, vaginal yeast infection affects up to 3 out of 4 women at some point in their lifetimes.', 1, 0, '2021-01-08 17:01:04', '2021-01-08 17:01:04'),
(230, 13, 'Miscarriage', 'Miscarriage is the most common type of pregnancy loss and often occurs because the foetus isn\'t developing normally.', 1, 0, '2021-01-08 17:01:23', '2021-01-08 17:01:23'),
(231, 13, 'Hypothyroidism', 'Hypothyroidism (underactive thyroid) is a condition in which your thyroid gland doesn\'t produce enough of certain crucial hormones. Hypothyroidism may not cause noticeable symptoms in the early stages.', 1, 0, '2021-01-08 17:01:46', '2021-01-08 17:01:46'),
(232, 13, 'Hyperthyroidism', 'Hyperthyroidism (overactive thyroid) occurs when your thyroid gland produces too much of the hormone thyroxine. Hyperthyroidism can accelerate your body\'s metabolism, causing unintentional weight loss and a rapid or irregular heartbeat', 1, 0, '2021-01-08 17:02:21', '2021-01-08 17:02:21'),
(233, 13, 'Hirsutism (Unwanted hairs face)', 'Hirsutism is a condition in women that results in excessive growth of dark or coarse hair in a male-like pattern — face, chest and back. With hirsutism, extra hair growth often arises from excess male hormones (androgens), primarily testosterone.', 1, 0, '2021-01-08 17:02:49', '2021-01-08 17:02:49'),
(234, 13, 'Obesity', 'Obesity is a complex disease involving an excessive amount of body fat. Obesity isn\'t just a cosmetic concern. It is a medical problem that increases your risk of other diseases and health problems, such as heart disease, diabetes, high blood pressure and certain cancers.', 1, 0, '2021-01-08 17:03:07', '2021-01-08 17:03:07'),
(235, 13, 'Hormonal Imbalance', 'Hormonal imbalances occur when there is too much or too little of a hormone in the bloodstream. Because of their essential role in the body, even small hormonal imbalances can cause side effects throughout the body. Hormones are chemicals that are produced by glands in the endocrine system.', 1, 0, '2021-01-08 17:03:49', '2021-01-08 17:03:49'),
(236, 13, 'Dysmenorrhea', 'Dysmenorrhea is the medical term for pain with menstruation. There are two types of dysmenorrhea: \"primary\" and \"secondary\". Primary dysmenorrhea is common menstrual cramps that are recurrent (come back) and are not due to other diseases.', 1, 0, '2021-01-08 17:04:15', '2021-01-08 17:04:15'),
(237, 13, 'Frigidity', 'Frigidity: Failure of a female to respond to sexual stimulus; aversion on the part of a woman to sexual intercourse; failure of a female to achieve an orgasm (anorgasmia) during sexual intercourse.', 1, 0, '2021-01-08 17:04:57', '2021-01-08 17:04:57'),
(238, 13, 'Nymphomania', 'Nymphomania is a mental disorder marked by compulsive sexual behavior. Compulsions are unwanted actions, or rituals, that a person engages in repeatedly without getting pleasure from them or being able to control them.', 1, 0, '2021-01-08 17:05:13', '2021-01-08 17:05:13'),
(239, 13, 'Breast atrophy', 'Breast atrophy is the normal or spontaneous atrophy or shrinkage of the breasts. Breast atrophy commonly occurs in women during menopause when estrogen levels decrease.', 1, 0, '2021-01-08 17:05:32', '2021-01-08 17:05:32'),
(240, 13, 'Breast cancer/ Fibroids', 'Breast cancer is cancer that forms in the cells of the breasts. After skin cancer, breast cancer is the most common cancer diagnosed in women in the United States. Breast cancer can occur in both men and women, but it\'s far more common in women. cancer treatment depends on disease stages. Homeopathy treatment based on symptomatic as a holistic approach to cure diseases, this treatment is not a final treatment for you and take further treatment consult to your doctor', 1, 0, '2021-01-08 17:06:05', '2021-01-08 17:06:05'),
(241, 14, 'Spermatorrhea (involuntary seminal emission)', 'Spermatorrhea is a condition of excessive, involuntary ejaculation.', 1, 0, '2021-01-08 17:06:35', '2021-01-08 17:06:35'),
(242, 14, 'Premature ejaculation', 'Premature ejaculation (PE) is when ejaculation happens sooner than a man or his partner would like during sex.', 1, 0, '2021-01-08 17:07:04', '2021-01-08 17:07:04'),
(243, 14, 'Loss of sexual power', 'Inhibited desire, or loss of libido, refers to a decrease in desire for, or interest in sexual activity.', 1, 0, '2021-01-08 17:07:23', '2021-01-08 17:07:23'),
(244, 14, 'Sexual neurasthenia (Night fall)', 'Nightfall in men is common in teenagers. Nightfall symptoms include premature ejaculation, anorexia, mood swings, muscle cramps, and laziness.', 1, 0, '2021-01-08 17:07:45', '2021-01-08 17:07:45'),
(245, 14, 'Herpes Zoster Genital parts', 'Genital herpes can be associated with extreme pain, edema, and dysuria.', 1, 0, '2021-01-08 17:08:20', '2021-01-08 17:08:20'),
(246, 14, 'Azospermia (Lack of sperms)', 'Low sperm count means that the fluid (semen) you ejaculate during an orgasm contains few sperm than normal.', 1, 0, '2021-01-08 17:08:46', '2021-01-08 17:08:46'),
(247, 14, 'Erectile dysfunction (impotence)', 'Occurs when a man can\'t get or keep an erection firm enough for sexual intercourse.', 1, 0, '2021-01-08 17:09:28', '2021-01-08 17:09:28'),
(248, 14, 'Orchitis', 'Orchitis is an inflammation of the testicles. It can be caused by either bacteria or a virus.', 1, 0, '2021-01-08 17:09:47', '2021-01-08 17:09:47'),
(249, 14, 'Hydrocele', 'A hydrocele is a type of swelling in the scrotum that occurs when fluid collects in the thin sheath surrounding a testicle. Hydrocele is common in new-borns and usually disappears without treatment by age 1. Older boys and adult men can develop a hydrocele due to inflammation or injury within the scrotum.', 1, 0, '2021-01-08 17:10:10', '2021-01-08 17:10:10'),
(250, 14, 'Masturbation', 'Masturbation is the self-stimulation of the genitals to achieve sexual arousal and pleasure, usually to the point of orgasm (sexual climax).', 1, 0, '2021-01-08 17:10:29', '2021-01-08 17:10:29'),
(251, 15, 'Autism', 'A serious developmental disorder that impairs the ability to communicate and interact.', 1, 0, '2021-01-08 17:14:22', '2021-01-08 17:14:22'),
(252, 15, 'Down’s syndrome', 'A genetic chromosome 21 disorder causing developmental and intellectual delays.', 1, 0, '2021-01-08 17:14:43', '2021-01-08 17:14:43'),
(253, 15, 'Obsessive compulsive disorder (OCD)', 'Excessive thoughts (obsessions) that lead to repetitive behaviours (compulsions).', 1, 0, '2021-01-08 17:15:32', '2021-01-08 17:15:32'),
(254, 15, 'Mental illness/ Debility', 'Debility is defined as: generally, weakness in function, loss of ability.', 1, 0, '2021-01-08 17:16:11', '2021-01-08 17:16:11'),
(255, 15, 'Alcoholism addiction', 'Alcohol addiction, also known as alcoholism, is a disease that affects people of all walks of life.', 1, 0, '2021-01-08 17:16:34', '2021-01-08 17:16:34'),
(256, 15, 'Intoxication', 'Intoxication is a condition that follows the administration of a psychoactive substance and results in disturbances in the level of consciousness, cognition, perception, judgement, affect, or behaviour, or other psychophysiological functions and responses.', 1, 0, '2021-01-08 17:17:05', '2021-01-08 17:17:05'),
(257, 15, 'Tobacco Chewing', 'Chewing tobacco is sometimes known as smokeless tobacco or spitting tobacco. It is available in two forms, snuff and chewing tobacco.', 1, 0, '2021-01-08 17:19:54', '2021-01-08 17:19:54'),
(258, 15, 'Homesickness', 'Homesickness is the distress caused by being away from home. Its cognitive hallmark is preoccupying thoughts of home and attachment objects.', 1, 0, '2021-01-08 17:20:21', '2021-01-08 17:20:21'),
(259, 15, 'Locomotor ataxia', 'Loss of coordination of movement, especially as a result of syphilitic infection of the spinal cord.', 1, 0, '2021-01-08 17:20:46', '2021-01-08 17:20:46'),
(260, 15, 'Myalgia', 'In medicine, myalgia, also known as muscle pain or muscle ache, is a symptom that presents with a large array of diseases.', 1, 0, '2021-01-08 17:21:10', '2021-01-08 17:21:10'),
(261, 15, 'Absent mind', 'Absent-mindedness is where a person shows inattentive or forgetful behavior.', 1, 0, '2021-01-08 17:21:35', '2021-01-08 17:21:35'),
(262, 15, 'Delirium', 'Delirium is an abrupt change in the brain that causes mental confusion and emotional disruption. It makes it difficult to think, remember, sleep, pay attention, and more. You might experience delirium during alcohol withdrawal, after surgery, or with dementia.', 1, 0, '2021-01-08 17:22:33', '2021-01-08 17:22:33'),
(263, 15, 'Hysteria', 'an uncontrollable outburst of emotion or fear, often characterized by irrationality, laughter, weeping, etc. ... a psychoneurotic disorder characterized by violent emotional outbreaks, disturbances of sensory and motor functions, and various abnormal effects due to autosuggestion.', 1, 0, '2021-01-08 17:22:55', '2021-01-08 17:22:55'),
(264, 15, 'Numbness', 'Numbness (lost, reduced, or altered sensation) and tingling (an odd prickling sensation) are types of temporary paresthesia. These sensations commonly occur after sitting or standing in a particular position or even wearing tight clothing for too long.', 1, 0, '2021-01-08 17:24:25', '2021-01-08 17:24:25'),
(265, 15, 'Tremors', 'Tremor is an involuntary, rhythmic muscle contraction leading to shaking movements in one or more parts of the body. It is a common movement disorder that most often affects the hands but can also occur in the arms, head, vocal cords, torso, and legs.', 1, 0, '2021-01-08 17:24:48', '2021-01-08 17:24:48'),
(266, 16, 'Teething trouble/ Dentition period', 'The typical time frame for teething to begin is usually between six and nine months although it may start as early as three months or as late as twelve months in some cases.', 1, 0, '2021-01-08 17:25:36', '2021-01-08 17:25:36'),
(267, 16, 'Nose bleeding (Epitasis)', 'Nosebleeds are common due to the location of the nose on the face, and the large amount of blood vessels in the nose.', 1, 0, '2021-01-08 17:27:14', '2021-01-08 17:27:14'),
(268, 16, 'Nocturnal enuresis (Bed wetting)', 'Night time loss of bladder control, or bed-wetting, usually in children.', 1, 0, '2021-01-08 17:27:37', '2021-01-08 17:27:37'),
(269, 16, 'Slow growth', 'A growth delay occurs when a child isn’t growing at the normal rate for their age', 1, 0, '2021-01-08 17:29:44', '2021-01-08 17:29:44'),
(270, 16, 'Weak immunity', 'The primary symptom of a weak immune system is susceptibility to infection. A person with a weak immune system is likely to get infections more frequently than most other people, and these illnesses might be more severe or harder to treat.', 1, 0, '2021-01-08 17:30:12', '2021-01-08 17:30:12'),
(271, 16, 'Hormonal Imbalance\'s', 'Hormonal imbalances occur when there is too much or too little of a hormone in the bloodstream.', 1, 0, '2021-01-08 17:30:31', '2021-01-08 17:30:31'),
(272, 16, 'Vitamin deficiency', 'Vitamin deficiency is the condition of a long-term lack of a vitamin. When caused by not enough vitamin intake it is classified as a primary deficiency, whereas when due to an underlying disorder such as malabsorption it is called a secondary deficiency.', 1, 0, '2021-01-08 17:31:22', '2021-01-08 17:31:22'),
(273, 16, 'Loss of appetite', 'A decreased appetite occurs when you have a reduced desire to          eat. It may also be known as a poor appetite or loss of appetite. The medical term for this is anorexia. A wide variety of conditions can cause your appetite to decrease.', 1, 0, '2021-01-08 17:31:46', '2021-01-08 17:31:46'),
(274, 16, 'Peevishness child', 'Easily annoyed by unimportant things; bad-tempered synonym irritable Sebastian was a sickly, peevish child. cross, querulous, or fretful, as from vexation or discontent: a peevish youngster. showing annoyance, irritation, or bad mood: a peevish reply; a peevish frown. perverse or obstinate', 1, 0, '2021-01-08 17:33:05', '2021-01-08 17:33:05'),
(275, 16, 'Anorexia - Anorexia nervosa', 'Often simply called anorexia — is an eating disorder characterized by an abnormally low body weight, an intense fear of gaining weight and a distorted perception of weight.', 1, 0, '2021-01-08 17:33:47', '2021-01-08 17:33:47'),
(276, 16, 'Angry child', 'Kids with extreme behavior problems.', 1, 0, '2021-01-08 17:34:08', '2021-01-08 17:34:08'),
(277, 17, 'Dengue fever', 'A mosquito-borne viral disease occurring in tropical and subtropical areas.', 1, 0, '2021-01-08 17:35:10', '2021-01-08 17:35:10'),
(278, 17, 'Typhoid fever', 'Typhoid fever is an infection that spreads through contaminated food and water.', 1, 0, '2021-01-08 17:35:30', '2021-01-08 17:35:30'),
(279, 17, 'Malaria fever', 'A disease caused by a plasmodium parasite, transmitted by the bite of infected mosquitoes.', 1, 0, '2021-01-08 17:35:59', '2021-01-08 17:35:59'),
(280, 17, 'Viral fever', 'A viral fever refers to any fever that results from a viral infection, such as the flu or dengue fever.', 1, 0, '2021-01-08 17:36:31', '2021-01-08 17:36:31'),
(281, 17, 'Influenza fever', 'Influenza hits fast. After an incubation period of just one to two days, the influenza symptoms start abruptly.', 1, 0, '2021-01-08 17:36:52', '2021-01-08 17:36:52'),
(282, 17, 'Hay fever', 'An allergic response causing itchy, watery eyes, sneezing and other similar symptoms.', 1, 0, '2021-01-08 17:37:16', '2021-01-08 17:37:16'),
(283, 18, 'Pimples  (face)', 'Overproduction of oil and a build-up of bacteria contribute to pimples on face.', 1, 0, '2021-01-08 17:39:31', '2021-01-08 17:39:31'),
(284, 18, 'Acne face', 'Acne is a skin condition that occurs when your hair follicles become plugged with oil and dead skin cells teenage problems.', 1, 0, '2021-01-08 17:40:08', '2021-01-08 17:40:08'),
(285, 18, 'Blackheads', 'An open (blackhead) or closed (whitehead) skin pore or hair follicle clogged with oil, dead skin cells and bacteria on face.', 1, 0, '2021-01-08 17:40:32', '2021-01-08 17:40:32'),
(286, 18, 'Wrinkled face', 'Wrinkles, also known as rhytides, are folds in your skin. As you age, your skin produces less of the proteins collagen and elastin.', 1, 0, '2021-01-08 17:41:29', '2021-01-08 17:41:29'),
(287, 18, 'Alopecia', 'Alopecia areata is a condition that causes hair to fall out in small patches, which can be unnoticeable. These patches may connect, however, and then become noticeable. The condition develops when the immune system attacks the hair follicles, resulting in hair loss.', 1, 0, '2021-01-08 17:43:34', '2021-01-08 17:43:34'),
(288, 18, 'Hirsutism face female', 'Hirsutism is a condition in women that results in excessive growth of dark or coarse hair in a male-like pattern — face, chest and back. With hirsutism, extra hair growth often arises from excess male hormones (androgens), primarily testosterone.', 1, 0, '2021-01-08 17:44:07', '2021-01-08 17:44:07'),
(289, 18, 'Oily / dry skin', 'Dry and oily skin often occurs in people who are chronically dehydrated. But the primary cause behind dry, oily skin is simply genetics. Combination skin means that you may have fine lines and wrinkles at the same time as acne, blackheads, and other oil-related breakout issues.', 1, 0, '2021-01-08 17:44:42', '2021-01-08 17:44:42'),
(290, 19, 'Pyorrhea (Gums swelling/ bleeding)', 'Bleeding gums are a sign of gingivitis, or inflammation of your gums. It\'s a common and mild form of gum disease, and it\'s caused by a buildup of plaque at your gumline.', 1, 0, '2021-01-08 17:45:14', '2021-01-08 17:45:14'),
(291, 19, 'Gingivitis', 'The cause is poor oral hygiene. Untreated gingivitis can lead to tooth loss and other serious conditions.', 1, 0, '2021-01-08 17:45:35', '2021-01-08 17:45:35'),
(292, 19, 'Dental caries', 'Permanently damaged areas in teeth that develop into tiny holes. Causes include bacteria, snacking, sipping sugary drinks and poor teeth cleaning.', 1, 0, '2021-01-08 17:46:30', '2021-01-08 17:46:30'),
(293, 19, 'Fetid smell (foul smell) mouth', 'Poor oral hygiene can cause your breath to smell like poop. Failing to brush and floss your teeth properly and regularly can make your breath smell because plaque and bacteria accumulate on and between your teeth.', 1, 0, '2021-01-08 17:46:55', '2021-01-08 17:46:55'),
(294, 19, 'Gums caries', 'Dental caries is a pandemic infectious disease which can affect the quality of life and consumes considerable health care resources.', 1, 0, '2021-01-08 17:47:22', '2021-01-08 17:47:22'),
(295, 19, 'Yellow teeth', 'Certain foods that are high in tannins, such as red wine, are potential causes of yellow teeth', 1, 0, '2021-01-08 17:47:49', '2021-04-16 06:24:59'),
(296, 5, 'Anal Fissure', 'An anal fissure is a small tear in the thin, moist tissue (mucosa) that lines the anus. An anal fissure may occur when you pass hard or large stools during a bowel movement.', 1, 0, NULL, NULL),
(297, 9, 'Vertigo', 'Vertigo is the feeling that you\'re moving when you\'re not. Or it might feel like things around you are moving when they aren\'t. Vertigo can feel similar to motion sickness. It may sign of chronic illness or neurologically.', 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `homeo_diseases_categories`
--

CREATE TABLE `homeo_diseases_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(6,2) NOT NULL DEFAULT '0.00',
  `discount_price` decimal(6,2) DEFAULT '0.00',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homeo_diseases_categories`
--

INSERT INTO `homeo_diseases_categories` (`id`, `title`, `description`, `image_name`, `image_url`, `price`, `discount_price`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Eye', 'Most people have eye problems at one time or another. Some are minor and will go away on their own, or are easy to treat at home. Others need a specialist’s care', 'Dental Care_1609822975.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/disease/Dental%20Care_1609822975.png', '299.00', '0.00', 1, 0, '2021-01-05 05:02:56', '2021-01-05 05:03:48'),
(2, 'Ear, Nose, Throat (ENT)', 'If you have a health problem with your head or neck, your doctor might recommend that you see an ENT surgeon. That\'s someone who treats issues in your ears, nose, or throat as well as related areas in your head and neck. They\'re called ENT\'s for short.', 'Ear, Nose, Throat (ENT)_1609834138.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/disease/Ear%2C%20Nose%2C%20Throat%20%28ENT%29_1609834138.png', '299.00', '0.00', 1, 0, '2021-01-05 08:08:58', '2021-01-11 11:38:54'),
(3, 'Mouth, Tongue', 'Your mouth is one of the most important parts of your body.  It is also important to keep your mouth clean and healthy by brushing, flossing, and not using tobacco', 'Mouth, Tongue_1609834230.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/disease/Mouth%2C%20Tongue_1609834230.png', '299.00', '0.00', 1, 0, '2021-01-05 08:10:30', '2021-01-05 08:10:30'),
(4, 'Respiratory tract system (Lungs)', 'Every cell of the body needs oxygen to stay alive and healthy. Let’s take a closer look at this complex system', 'Respiratory tract system (Lungs)_1609834323.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/disease/Respiratory%20tract%20system%20%28Lungs%29_1609834323.png', '299.00', '0.00', 1, 0, '2021-01-05 08:12:03', '2021-01-05 08:12:03'),
(5, 'Gastrointestinal System (GIT)', 'The mucosal integrity of the gastrointestinal tract and the functioning of its accessory organs are vital in maintaining the health', 'Gastrointestinal System (GIT)_1609834372.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/disease/Gastrointestinal%20System%20%28GIT%29_1609834372.png', '299.00', '0.00', 1, 0, '2021-01-05 08:12:52', '2021-01-05 08:12:52'),
(6, 'Liver, Gallbladder, Pancreas', 'The liver, pancreas and gall bladder are called accessory organs.  Let’s take a closer look at this', 'Liver, Gallbladder, Pancreas_1609834428.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/disease/Liver%2C%20Gallbladder%2C%20Pancreas_1609834428.png', '299.00', '0.00', 1, 0, '2021-01-05 08:13:48', '2021-01-05 08:13:48'),
(7, 'Urinary tract system', 'The urinary system, also known as the renal system or urinary tract, consists of the kidneys, ureters, bladder, and the urethra. These can be treated by a urologist or another health care professional', 'Urinary tract system_1609834472.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/disease/Urinary%20tract%20system_1609834472.png', '299.00', '0.00', 1, 0, '2021-01-05 08:14:32', '2021-01-05 08:14:32'),
(8, 'Blood Vascular System (Heart disease/Cardiology)', 'Cardiovascular diseases are conditions that affect the structures or function of your heart, Consult with us and stay healthy', 'Blood Vascular System (Heart disease/Cardiology)_1609834507.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/disease/Blood%20Vascular%20System%20%28Heart%20disease/Cardiology%29_1609834507.png', '299.00', '0.00', 1, 0, '2021-01-05 08:15:07', '2021-01-05 08:15:07'),
(9, 'Nervous System (Neurology) Head, Brain', 'Neurology is the branch of medicine concerned with the study and treatment of disorders of the nervous system', 'Nervous System (Neurology) Head, Brain_1609836414.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/disease/Nervous%20System%20%28Neurology%29%20Head%2C%20Brain_1609836414.png', '299.00', '0.00', 1, 0, '2021-01-05 08:46:54', '2021-01-05 08:46:54'),
(10, 'Muscles, Bones, Joints (Orthopedic)', 'The human musculoskeletal system is an organ system that gives humans the ability to move using their muscular and skeletal systems', 'Muscles, Bones, Joints (Orthopedic)_1609838781.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/disease/Muscles%2C%20Bones%2C%20Joints%20%28Orthopedic%29_1609838781.png', '299.00', '0.00', 1, 0, '2021-01-05 09:26:21', '2021-01-05 09:26:21'),
(11, 'Skin & Allergy', 'Allergic contact dermatitis occurs when the skin comes into direct contact with an allergen. The result of the skin allergy is a red, itchy rash that can include small blisters or bumps. The rash arises whenever the skin comes into contact with the allergen, a substance that the immune system attacks.', 'Skin, Allergy, Glow, Beauty_1609838828.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/disease/Skin%2C%20Allergy%2C%20Glow%2C%20Beauty_1609838828.png', '299.00', '0.00', 1, 0, '2021-01-05 09:27:08', '2021-01-05 09:27:08'),
(12, 'Hair & Nail / Scalp', 'Your hair says a lot about you. Your choice of hairstyle can tell other people if you’re adventurous or maybe a little more reserved', 'Hair & Nail / Scalp_1609838881.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/disease/Hair%20%26%20Nail%20/%20Scalp_1609838881.png', '299.00', '0.00', 1, 0, '2021-01-05 09:28:01', '2021-01-05 09:28:01'),
(13, 'Gynecological disorders (Female)', 'Gynecological disorders affect the internal and external organs in the female pelvic and abdominal areas', 'Gynecological disorders (Female)_1609838930.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/disease/Gynecological%20disorders%20%28Female%29_1609838930.png', '299.00', '0.00', 1, 0, '2021-01-05 09:28:50', '2021-01-05 09:28:50'),
(14, 'Male Sexual Health', 'Although adolescent males have as many health issues and concerns as adolescent females, they are much less likely to be seen in a clinical setting', 'Male Sexual Health_1609838957.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/disease/Male%20Sexual%20Health_1609838957.png', '299.00', '0.00', 1, 0, '2021-01-05 09:29:17', '2021-01-05 09:29:17'),
(15, 'Neurological diseases', 'Neurological disorders are increasingly recognised as major causes of death and disability worldwide. Our Aim is to provide awareness and treatment from our best neurologist', 'Neurological diseases_1609838988.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/disease/Neurological%20diseases_1609838988.png', '299.00', '0.00', 1, 0, '2021-01-05 09:29:48', '2021-01-05 09:29:48'),
(16, 'Children’s diseases (Pediatrics)', 'The term childhood disease refers to disease that is contracted or becomes symptomatic before the age of 18 years old. Many of these diseases can also be contracted by adults', 'Children’s diseases (Pediatrics)_1609839016.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/disease/Children%E2%80%99s%20diseases%20%28Pediatrics%29_1609839016.png', '299.00', '0.00', 1, 0, '2021-01-05 09:30:16', '2021-01-05 09:30:16'),
(17, 'Fever', 'Misconceptions about the dangers of fever are commonplace. Unwarranted fears about harmful side effects from fever cause lost sleep and unnecessary stress for many people', 'Fever_1609839053.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/disease/Fever_1609839053.png', '299.00', '0.00', 1, 0, '2021-01-05 09:30:53', '2021-01-05 09:30:53'),
(18, 'Homeo cosmetic (Beautician / parlor)', 'Learn about a few of the top ingredients and contaminants to avoid, based on the science linking each to adverse health impacts, and the types of products they’re found in', 'Homeo cosmetic (Beautician / parlor)_1609839083.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/disease/Homeo%20cosmetic%20%28Beautician%20/%20parlor%29_1609839083.png', '299.00', '0.00', 1, 0, '2021-01-05 09:31:23', '2021-01-05 09:31:23'),
(19, 'Dental Care', 'Oral disease affects 3.9 billion people worldwide1, with untreated tooth decay (dental caries) impacting almost half of the world’s population', 'Dental Care_1609839113.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/disease/Dental%20Care_1609839113.png', '299.00', '0.00', 1, 0, '2021-01-05 09:31:53', '2021-04-16 05:28:11');

-- --------------------------------------------------------

--
-- Table structure for table `homeo_doctors`
--

CREATE TABLE `homeo_doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `gender` enum('male','female','other') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'other',
  `dob` date NOT NULL DEFAULT '1000-01-01',
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_husband_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homeo_doctors`
--

INSERT INTO `homeo_doctors` (`id`, `user_id`, `gender`, `dob`, `image_name`, `image_url`, `father_husband_name`, `spouse_name`, `spouse_mobile`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 2, 'male', '1000-01-01', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, '2021-03-09 16:49:13');

-- --------------------------------------------------------

--
-- Table structure for table `homeo_general_settings`
--

CREATE TABLE `homeo_general_settings` (
  `id` int(11) NOT NULL,
  `group` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0=>In-active, 1=> Active',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `homeo_media_images`
--

CREATE TABLE `homeo_media_images` (
  `id` int(11) NOT NULL,
  `group_type` varchar(20) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `homeo_medical_records`
--

CREATE TABLE `homeo_medical_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` int(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `medical_status` enum('past','ongoing') COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_from` date NOT NULL,
  `time_to` date DEFAULT NULL,
  `result` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homeo_medical_records`
--

INSERT INTO `homeo_medical_records` (`id`, `patient_id`, `title`, `medical_status`, `type`, `time_from`, `time_to`, `result`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'TEST', 'past', 'TEST', '2021-03-15', '2021-03-15', 'TEST', 1, 0, '2021-03-15 14:17:11', '2021-03-15 14:17:11'),
(2, 1, 'TEST1', 'ongoing', 'TEST1', '2021-03-15', '2021-03-15', 'TEST1', 1, 0, '2021-03-15 14:17:02', '2021-03-15 14:17:02'),
(3, 2, 'TEST2', 'past', 'TEST2', '2021-03-15', '2021-03-15', 'TEST1', 1, 0, '2021-03-15 14:17:02', '2021-03-15 14:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `homeo_medical_record_images`
--

CREATE TABLE `homeo_medical_record_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `medical_record_id` bigint(20) UNSIGNED NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `homeo_menus`
--

CREATE TABLE `homeo_menus` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(155) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `page_id` int(11) NOT NULL,
  `menu_order` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homeo_menus`
--

INSERT INTO `homeo_menus` (`id`, `group_id`, `parent_id`, `name`, `slug`, `page_id`, `menu_order`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'Home', 'home', 1, 1, 1, 0, '2019-10-14 11:21:49', '2021-03-11 12:34:41'),
(2, 1, 0, 'About Us', 'about-us', 2, 2, 1, 0, '2019-10-14 11:22:01', '2019-10-15 05:46:18'),
(6, 1, 0, 'Contact Us', 'contact-us', 6, 6, 1, 0, '2019-10-14 11:23:16', '2019-10-15 05:44:47');

-- --------------------------------------------------------

--
-- Table structure for table `homeo_modules`
--

CREATE TABLE `homeo_modules` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `fa_icon` varchar(50) DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `has_sub_menu` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `is_visible` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0 => False, 1 => True',
  `is_action` tinyint(2) NOT NULL DEFAULT '0',
  `allowed_user_roles` varchar(30) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0=>In-active, 1=> Active	',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `order_by` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homeo_modules`
--

INSERT INTO `homeo_modules` (`id`, `parent_id`, `name`, `fa_icon`, `controller`, `action`, `has_sub_menu`, `is_visible`, `is_action`, `allowed_user_roles`, `status`, `is_deleted`, `order_by`, `created_at`, `updated_at`) VALUES
(1, 0, 'Dashboard', 'fa fa-dashboard', 'dashboard', NULL, 0, 1, 0, '0', 1, 0, 0, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(2, 0, 'Media', 'fa fa-file-image-o', 'media', NULL, 0, 1, 0, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(3, 0, 'Menus', 'fa fa-bars', 'menu', NULL, 1, 1, 0, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(4, 0, 'Posts', 'fa fa-thumb-tack', 'post', NULL, 1, 1, 0, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(5, 4, 'All Posts', 'fa fa-circle-o', 'post', NULL, 0, 1, 0, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(6, 4, 'Add New', 'fa fa-circle-o', 'post', 'add', 0, 1, 1, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(7, 4, 'Edit', 'fa fa-circle-o', 'post', 'edit', 0, 0, 1, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(8, 4, 'Delete', 'fa fa-circle-o', 'post', 'delete', 0, 0, 1, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(9, 4, 'Categories', 'fa fa-circle-o', 'post', 'category', 0, 1, 0, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(16, 0, 'Pages', 'fa fa-file-text-o', 'page', NULL, 1, 1, 0, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(17, 16, 'All Pages', 'fa fa-circle-o', 'page', NULL, 0, 1, 0, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(18, 16, 'Add New', 'fa fa-circle-o', 'page', 'add', 0, 1, 0, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(19, 16, 'Edit', 'fa fa-circle-o', 'page', 'edit', 0, 0, 0, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(20, 16, 'Delete', 'fa fa-circle-o', 'page', 'delte', 0, 0, 0, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(69, 0, 'User Management', 'fa fa-thumb-tack', 'user-management', NULL, 1, 1, 0, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(70, 0, 'User Role', 'fa fa-id-badge', 'user-role', NULL, 0, 1, 0, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(71, 0, 'User Permission', 'fa fa-snowflake-o', 'user-permission', NULL, 1, 1, 0, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(78, 0, 'General Settings', 'fa fa-cog', 'general-settings', NULL, 0, 0, 0, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(79, 71, 'Edit', 'fa fa-thumb-tack', 'user-permission', 'edit', 0, 0, 0, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(80, 0, 'Action Log', 'fa fa-thumb-tack', 'action-logs', 'history', 0, 0, 0, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(81, 71, 'View All', 'fa fa-thumb-tack', 'user-permission', NULL, 0, 1, 0, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(82, 69, 'View All', 'fa fa-circle-o', 'user-management', NULL, 0, 1, 0, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(83, 69, 'Add New', 'fa fa-circle-o', 'user-management', 'add', 0, 1, 1, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(84, 69, 'Edit', 'fa fa-circle-o', 'user-management', 'edit', 0, 0, 1, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(85, 69, 'Delete', 'fa fa-circle-o', 'user-management', 'delete', 0, 0, 1, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(117, 0, 'Sliders', 'fa fa-sliders', 'slider', NULL, 1, 0, 0, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(118, 117, 'All Sliders', 'fa fa-circle-o', 'slider', NULL, 0, 1, 0, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(119, 117, 'Add New', 'fa fa-circle-o', 'slider', 'add', 0, 1, 1, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(120, 117, 'Edit', 'fa fa-circle-o', 'slider', 'edit', 0, 0, 1, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(121, 117, 'Delete', 'fa fa-circle-o', 'slider', 'delete', 0, 0, 1, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(122, 117, 'Slider Images', 'fa fa-circle-o', 'slider-images', NULL, 0, 0, 0, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(124, 3, 'All Menus', 'fa fa-circle-o', 'menu', NULL, 0, 1, 0, '0', 1, 0, 1, '2019-10-14 00:00:00', '2019-10-14 00:00:00'),
(125, 3, 'Add New', 'fa fa-circle-o', 'menu', 'add', 0, 1, 1, '0', 1, 0, 1, '2019-10-14 00:00:00', '2019-10-14 00:00:00'),
(126, 3, 'Edit', 'fa fa-circle-o', 'menu', 'edit', 0, 0, 1, '0', 1, 0, 1, '2019-10-14 00:00:00', '2019-10-14 00:00:00'),
(127, 3, 'Delete', 'fa fa-circle-o', 'menu', 'delete', 0, 0, 1, '0', 1, 0, 1, '2019-10-14 00:00:00', '2019-10-14 00:00:00'),
(139, 0, 'Patient', 'fa fa-heart', 'patient', NULL, 1, 1, 0, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(140, 139, 'View All', 'fa fa-circle-o', 'patient', NULL, 0, 1, 0, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(141, 139, 'View', 'fa fa-circle-o', 'patient', 'view', 0, 0, 1, '0', 1, 0, 1, '2019-10-14 00:00:00', '2019-10-14 00:00:00'),
(142, 0, 'Profile', 'fa fa-id-badge', 'profile', NULL, 0, 1, 1, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(143, 0, 'Consult', 'fa fa-id-badge', 'consult', NULL, 1, 0, 1, '0', 1, 0, 1, '2021-04-05 17:25:54', '2021-04-05 17:25:54'),
(144, 143, 'View', 'fa fa-id-badge', 'consult', 'view', 0, 0, 1, '0', 1, 0, 1, '2021-04-05 17:25:54', '2021-04-05 17:25:54'),
(145, 0, 'Diseases category', 'fa fa-id-badge', 'disease-category', NULL, 1, 1, 1, '0', 1, 0, 1, '2021-04-05 17:25:54', '2021-04-05 17:25:54'),
(146, 145, 'View All', 'fa fa-circle-o', 'disease-category', NULL, 0, 1, 1, '0', 1, 0, 1, '2021-04-05 17:25:54', '2021-04-05 17:25:54'),
(147, 0, 'Advertisement', 'fa fa-id-badge', 'advertisement', NULL, 1, 1, 1, '0', 1, 0, 1, '2021-04-05 17:25:54', '2021-04-05 17:25:54'),
(148, 147, 'View All', 'fa fa-circle-o', 'advertisement', NULL, 0, 1, 1, '0', 1, 0, 1, '2021-04-05 17:25:54', '2021-04-05 17:25:54'),
(149, 145, 'Category Edit', 'fa fa-circle-o', 'disease-category', 'edit', 0, 0, 1, '0', 1, 0, 1, '2019-10-14 00:00:00', '2019-10-14 00:00:00'),
(150, 145, 'List', 'fa fa-circle-o', 'disease-list', 'list', 0, 0, 1, '0', 1, 0, 1, '2019-10-14 00:00:00', '2019-10-14 00:00:00'),
(151, 145, 'Disease Edit', 'fa fa-circle-o', 'disease', 'edit', 0, 0, 1, '0', 1, 0, 1, '2019-10-14 00:00:00', '2019-10-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `homeo_news`
--

CREATE TABLE `homeo_news` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `short_description` text,
  `content` longtext,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0',
  `publish_date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `homeo_news_gallery`
--

CREATE TABLE `homeo_news_gallery` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `homeo_pages`
--

CREATE TABLE `homeo_pages` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `content` longtext,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text,
  `meta_keywords` text,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homeo_pages`
--

INSERT INTO `homeo_pages` (`id`, `title`, `slug`, `content`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Home', 'home', NULL, NULL, NULL, NULL, 1, 0, '2019-10-15 05:43:21', '2019-10-15 05:43:21'),
(2, 'About Us', 'about-us', NULL, NULL, NULL, NULL, 1, 0, '2019-10-15 05:43:29', '2019-10-15 05:43:29'),
(6, 'Contact Us', 'contact-us', NULL, NULL, NULL, NULL, 1, 0, '2019-10-15 05:44:07', '2019-10-15 05:44:07');

-- --------------------------------------------------------

--
-- Table structure for table `homeo_patient`
--

CREATE TABLE `homeo_patient` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female','other') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'other',
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1000-01-01',
  `blood_group` enum('A+','B+','O+','AB+','A-','B-','O-','AB-') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` decimal(6,2) DEFAULT NULL,
  `weight` decimal(6,2) DEFAULT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smoking` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alcohol` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daily_routine_work` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diet` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homeo_patient`
--

INSERT INTO `homeo_patient` (`id`, `user_id`, `gender`, `dob`, `blood_group`, `marital_status`, `height`, `weight`, `image_name`, `image_url`, `smoking`, `alcohol`, `daily_routine_work`, `diet`, `occupation`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, '3', 'male', '1000-01-01', 'B+', 'single', '173.00', '74.00', NULL, NULL, 'NON', 'NON', 'busy', 'VEG', 'IT', 1, 0, '2021-03-13 12:19:50', '2021-03-13 12:19:50'),
(2, '4', 'female', '1000-01-01', 'B+', 'Married', '180.00', '80.00', NULL, NULL, 'NON', 'NON', 'busy', 'VEG', 'IT', 1, 0, '2021-03-13 12:19:50', '2021-03-13 12:19:50'),
(3, '5', 'male', '1998-10-04', 'AB+', 'single', '173.00', '70.00', NULL, NULL, 'none', 'none', 'busy', 'veg', 'IT', 1, 0, '2021-03-28 02:15:52', '2021-03-28 02:58:42');

-- --------------------------------------------------------

--
-- Table structure for table `homeo_permissions`
--

CREATE TABLE `homeo_permissions` (
  `id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0=>In-active, 1=> Active	',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 =>False, 1 => True	',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homeo_permissions`
--

INSERT INTO `homeo_permissions` (`id`, `module_id`, `role_id`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(305, 80, 1, 1, 0, '2020-11-18 04:24:25', '2020-11-18 04:24:25'),
(306, 1, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(307, 128, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(308, 129, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(309, 131, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(310, 133, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(311, 78, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(312, 2, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(313, 3, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(314, 124, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(315, 125, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(316, 126, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(317, 127, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(318, 16, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(319, 17, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(320, 18, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(321, 19, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(322, 20, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(323, 4, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(324, 5, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(325, 6, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(326, 7, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(327, 8, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(328, 9, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(329, 117, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(330, 118, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(331, 119, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(332, 120, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(333, 121, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(334, 122, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(335, 69, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(336, 82, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(337, 83, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(338, 84, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(339, 85, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(340, 71, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(341, 79, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(342, 81, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(343, 70, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(344, 134, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(345, 135, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(346, 136, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(347, 137, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(348, 138, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(361, 143, 4, 1, 0, '2021-04-08 03:09:58', '2021-04-08 03:09:58'),
(362, 144, 4, 1, 0, '2021-04-08 03:09:58', '2021-04-08 03:09:58'),
(363, 1, 4, 1, 0, '2021-04-08 03:09:58', '2021-04-08 03:09:58'),
(364, 139, 4, 1, 0, '2021-04-08 03:09:58', '2021-04-08 03:09:58'),
(365, 140, 4, 1, 0, '2021-04-08 03:09:58', '2021-04-08 03:09:58'),
(366, 141, 4, 1, 0, '2021-04-08 03:09:58', '2021-04-08 03:09:58'),
(367, 142, 4, 1, 0, '2021-04-08 03:09:58', '2021-04-08 03:09:58'),
(389, 147, 2, 1, 0, '2021-04-16 11:26:30', '2021-04-16 11:26:30'),
(390, 148, 2, 1, 0, '2021-04-16 11:26:30', '2021-04-16 11:26:30'),
(391, 1, 2, 1, 0, '2021-04-16 11:26:30', '2021-04-16 11:26:30'),
(392, 145, 2, 1, 0, '2021-04-16 11:26:30', '2021-04-16 11:26:30'),
(393, 146, 2, 1, 0, '2021-04-16 11:26:30', '2021-04-16 11:26:30'),
(394, 149, 2, 1, 0, '2021-04-16 11:26:30', '2021-04-16 11:26:30'),
(395, 150, 2, 1, 0, '2021-04-16 11:26:30', '2021-04-16 11:26:30'),
(396, 151, 2, 1, 0, '2021-04-16 11:26:30', '2021-04-16 11:26:30');

-- --------------------------------------------------------

--
-- Table structure for table `homeo_posts`
--

CREATE TABLE `homeo_posts` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `featured_image` varchar(255) DEFAULT NULL,
  `short_content` varchar(255) DEFAULT NULL,
  `content` longtext,
  `share_url` varchar(255) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0',
  `publish_date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `homeo_sliders`
--

CREATE TABLE `homeo_sliders` (
  `id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `homeo_slider_images`
--

CREATE TABLE `homeo_slider_images` (
  `id` int(11) NOT NULL,
  `slider_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `homeo_static_texts`
--

CREATE TABLE `homeo_static_texts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `used_for` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homeo_static_texts`
--

INSERT INTO `homeo_static_texts` (`id`, `used_for`, `content`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'dashboard-slider', 'Homeopathy is a system of alternative medicine of treatment through natural way without side effect. Free online consultant by specialist homeopathic doctors for 3 month 24×7 days.', 1, 0, '2021-02-27 22:33:55', '2021-02-27 22:33:55');

-- --------------------------------------------------------

--
-- Table structure for table `homeo_users`
--

CREATE TABLE `homeo_users` (
  `id` int(11) NOT NULL,
  `role_id` tinyint(4) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `remember_token` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `ip` varchar(30) DEFAULT NULL,
  `fb_token` varchar(255) DEFAULT NULL,
  `g_token` varchar(255) DEFAULT NULL,
  `api_token` varchar(255) DEFAULT NULL,
  `marketing` tinyint(4) NOT NULL DEFAULT '0',
  `otp` int(10) DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homeo_users`
--

INSERT INTO `homeo_users` (`id`, `role_id`, `name`, `email`, `password`, `mobile`, `remember_token`, `address`, `status`, `ip`, `fb_token`, `g_token`, `api_token`, `marketing`, `otp`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'rajat@gmail.com', '$2y$10$jKPgNtYWaIgefBF.lOhJneaGSAMHE8bYBS.ty3B/wlh6rQcXYDh.C', NULL, 'WxRjshWgzJujePQKFx18tJoWqajOz0Kk7SWGqPeQADmYzJOJ9Gg3J6kWRmAl', NULL, 1, NULL, NULL, NULL, NULL, 0, NULL, 0, '2019-10-14 00:00:00', '2021-01-26 04:58:30'),
(2, 4, 'Rajat Singh', 'rajat@doctor.com', '$2y$10$OxE/vEs98wpjPnXt8c27v.W3WETcqHBzni1ZOUa91i9BX2VGa3D3O', NULL, 'zE4xza4OmMNGksFZ88f9CMT1CNeyPaxn5FL03FaAdfWhmI9GjXloePzIk16x', NULL, 1, NULL, NULL, NULL, NULL, 0, NULL, 0, '2021-03-11 12:37:30', '2021-03-11 12:37:30'),
(3, 3, 'Rajat Patient1', 'rajat@patient.com', '$2y$10$ODNJFK.hwgysdHfHUVXHte6obCPusCQbabT8EI7fqz7XDHMZwL4ce', '8696383340', '', NULL, 1, '127.0.0.1', NULL, NULL, 'd5b78d670a28f379541d0e9f4232b6a8dc0ea6c641b543de7c04dd6ff25d2f18', 1, 763013, 0, '2021-03-13 11:26:38', '2021-03-28 08:28:42'),
(4, 3, 'Patient 2', 'patient2@gmail.com', '$2y$10$jC0/y77ivLBZm3QkICWK7OwYcfo8CRPPLbZQSM54q30Lq/qj5DXwK', NULL, '', NULL, 1, NULL, NULL, NULL, NULL, 0, NULL, 0, '2021-03-13 11:26:58', '2021-03-13 11:26:58'),
(5, 3, 'Patient 3', 'patient3@gmail.com', '$2y$10$jC0/y77ivLBZm3QkICWK7OwYcfo8CRPPLbZQSM54q30Lq/qj5DXwK', '8696383341', '', NULL, 1, '127.0.0.1', NULL, NULL, NULL, 0, 601101, 0, '2021-03-28 07:45:52', '2021-03-28 07:45:52'),
(6, 2, 'Admin', 'admin@homeodocs.com', '$2y$10$IDnGn2TU9F2w7/mxdKCuvuAFqfvXiDD5KjNSImtlro0bqZKugmH/q', NULL, 'UiNQggMXMFsnmNts2HRIDGTvyB2lDxMmjMCUKRobdKdMS3BazK2QUmXTEM3a', NULL, 1, NULL, NULL, NULL, NULL, 0, NULL, 0, '2021-04-13 04:46:52', '2021-04-13 04:46:52');

-- --------------------------------------------------------

--
-- Table structure for table `homeo_user_roles`
--

CREATE TABLE `homeo_user_roles` (
  `id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `home_page` varchar(100) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homeo_user_roles`
--

INSERT INTO `homeo_user_roles` (`id`, `role`, `home_page`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'System Admin', 'dashboard', 1, 0, '2019-10-14 00:00:00', '2021-03-11 12:29:30'),
(2, 'Admin', NULL, 1, 0, '2021-03-11 12:29:38', '2021-03-11 12:29:38'),
(3, 'Patient', NULL, 1, 0, '2021-03-11 12:29:44', '2021-03-11 12:29:44'),
(4, 'Doctor', NULL, 1, 0, '2021-03-11 12:29:46', '2021-03-11 12:29:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `homeo_action_logs`
--
ALTER TABLE `homeo_action_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_advertisements`
--
ALTER TABLE `homeo_advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_categories`
--
ALTER TABLE `homeo_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_consults`
--
ALTER TABLE `homeo_consults`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_consult_images`
--
ALTER TABLE `homeo_consult_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_contact_us`
--
ALTER TABLE `homeo_contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_diseases`
--
ALTER TABLE `homeo_diseases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `disease_categories_title_unique` (`title`);

--
-- Indexes for table `homeo_diseases_categories`
--
ALTER TABLE `homeo_diseases_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `diseases_title_unique` (`title`);

--
-- Indexes for table `homeo_doctors`
--
ALTER TABLE `homeo_doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_general_settings`
--
ALTER TABLE `homeo_general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_media_images`
--
ALTER TABLE `homeo_media_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_medical_records`
--
ALTER TABLE `homeo_medical_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_medical_record_images`
--
ALTER TABLE `homeo_medical_record_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_menus`
--
ALTER TABLE `homeo_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_modules`
--
ALTER TABLE `homeo_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_news`
--
ALTER TABLE `homeo_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_news_gallery`
--
ALTER TABLE `homeo_news_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_pages`
--
ALTER TABLE `homeo_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_patient`
--
ALTER TABLE `homeo_patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_permissions`
--
ALTER TABLE `homeo_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_posts`
--
ALTER TABLE `homeo_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_sliders`
--
ALTER TABLE `homeo_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_slider_images`
--
ALTER TABLE `homeo_slider_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_static_texts`
--
ALTER TABLE `homeo_static_texts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_users`
--
ALTER TABLE `homeo_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_user_roles`
--
ALTER TABLE `homeo_user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `homeo_action_logs`
--
ALTER TABLE `homeo_action_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeo_advertisements`
--
ALTER TABLE `homeo_advertisements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `homeo_categories`
--
ALTER TABLE `homeo_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeo_consults`
--
ALTER TABLE `homeo_consults`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `homeo_consult_images`
--
ALTER TABLE `homeo_consult_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeo_contact_us`
--
ALTER TABLE `homeo_contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeo_diseases`
--
ALTER TABLE `homeo_diseases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298;

--
-- AUTO_INCREMENT for table `homeo_diseases_categories`
--
ALTER TABLE `homeo_diseases_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `homeo_doctors`
--
ALTER TABLE `homeo_doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `homeo_general_settings`
--
ALTER TABLE `homeo_general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeo_media_images`
--
ALTER TABLE `homeo_media_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeo_medical_records`
--
ALTER TABLE `homeo_medical_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `homeo_medical_record_images`
--
ALTER TABLE `homeo_medical_record_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeo_menus`
--
ALTER TABLE `homeo_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `homeo_modules`
--
ALTER TABLE `homeo_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `homeo_news`
--
ALTER TABLE `homeo_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeo_news_gallery`
--
ALTER TABLE `homeo_news_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeo_pages`
--
ALTER TABLE `homeo_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `homeo_patient`
--
ALTER TABLE `homeo_patient`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `homeo_permissions`
--
ALTER TABLE `homeo_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=397;

--
-- AUTO_INCREMENT for table `homeo_posts`
--
ALTER TABLE `homeo_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeo_sliders`
--
ALTER TABLE `homeo_sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeo_slider_images`
--
ALTER TABLE `homeo_slider_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeo_static_texts`
--
ALTER TABLE `homeo_static_texts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `homeo_users`
--
ALTER TABLE `homeo_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `homeo_user_roles`
--
ALTER TABLE `homeo_user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
