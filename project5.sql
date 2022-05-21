-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2022 at 06:20 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project5`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `user_id`, `date`, `total`) VALUES
(1, 1, '2022-05-21 13:58:22', 43);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `product_id`, `quantity`, `user_id`) VALUES
(16, 50, 1, 1),
(17, 13, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Hair Products'),
(2, 'Fragrance Preparations'),
(3, 'Makeup Preparations '),
(4, 'skin Care Preparations');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `product_id`, `user_id`) VALUES
(1, 'Hi Everybody Amazing product', 13, 2),
(2, 'great smell', 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `namee` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subjectt` varchar(255) NOT NULL,
  `messagee` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `product_id`, `quantity`, `bill_id`) VALUES
(5, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `category_id` int(100) NOT NULL,
  `name` text NOT NULL,
  `price` decimal(22,2) NOT NULL,
  `sale_status` tinyint(1) NOT NULL,
  `sale_pre` decimal(6,2) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `price`, `sale_status`, `sale_pre`, `description`, `image`, `status`) VALUES
(1, 1, 'Kérastase Elixir Ultime Hydrating Hair Oil Serum', '43.05', 1, '30.00', 'A blend of four precious hair oils that adds hydration and prevents breakage for anti-frizz shine.', './Images/ProductsImages/p1cat1.png', 'on stock'),
(2, 1, 'Briogeo Curl Charisma™ Rice Amino + Quinoa Frizz Control Gel', '81.90', 0, '0.00', 'A defining styling gel to minimize frizz and enhance curl formation and strength.', './Images/ProductsImages/p2cat1.png', 'on stock'),
(3, 1, 'Living Proof Mini Curl Definer Conditioning Cream\r\n', '56.90', 0, '0.00', 'A conditioning styler that strengthens, defines, and conditions for bouncy, shiny, frizz-free curls.', './Images/ProductsImages/p3cat1.png', 'on stock'),
(5, 1, 'BIOLAGE Color Last Shampoo\r\n', '90.30', 0, '0.00', 'Helps Protect Hair & Maintain Vibrant Color\r\n', '.\\Images\\ProductsImages\\p5cat1.jpg', 'on stock'),
(6, 1, 'ACTIIV Recover Thickening Cleansing Hair Loss Shampoo Treatment for Women\r\n', '40.80', 0, '0.00', 'Targets hair loss with plant-based compounds that leave hair and scalp healthy and thriving. Non-daily use.', '.\\Images\\ProductsImages\\p4cat1.jpg', 'on stock'),
(8, 1, 'SheaMoisture Curl and Shine Coconut Shampoo \r\n', '70.20', 0, '0.00', 'This curl enhancing shampoo is a natural hair shampoo that contains coconut oil to moisturize and protect hair while replenishing lost oil “Dye free”.\r\nThe rich, creamy lather of Shea Moisture’s gently washes away impurities, leaving you with frizz free waves and curls.\r\n', '.\\Images\\ProductsImages\\p6cat1.jpg', 'on stock'),
(9, 1, 'Rebecca Products: To The Moon Mist\r\n', '30.00', 0, '0.00', 'Mist adds incredible volume to the hair\r\nNo stiff or tacky feel.\r\nProvides fabulous amounts of body and shine\r\nAlcohol free.\r\n', '.\\Images\\ProductsImages\\p7cat1.jpg', 'on stock'),
(10, 1, 'Herbal Essences Set Me Up Spray Gel\r\n', '55.00', 0, '0.00', 'Herbal Essences Set Me Up Spray Gel: Single\r\n Bottle\r\nExtra hold formula that\'s strong and flexible all\r\n  day long\r\nFor hair styles with luscious shine\r\nWith Lily Bliss fragrance\r\nLevel 3: Strong Hold\r\n', '.\\Images\\ProductsImages\\p8cat1.jpg', 'on stock'),
(11, 1, 'REVIV3 PROCARE PRIME Moisture+ Conditioner', '20.30', 0, '0.00', 'Conatins glycoprotein, vitamin complex and botanical extract\r\n', '.\\Images\\ProductsImages\\p9cat1.jpg', 'on stock'),
(12, 1, 'GIOVANNI 2chic Ultra-Revive Intensive Hair Mask', '60.80', 0, '0.00', 'COLOR SAFE: it’s 100% color-safe and nourishes hair with a proprietary blend of vitamins, antioxidants, and omega fatty acids without stripping color.\r\nVEGAN-FRIENDLY & CRUELTY-FREE: GIOVANNI Products use a number of organic ingredients and are Leaping Bunny Certified cruelty free. GIOVANNI Products are never tested on animals and come in sophisticated recyclable packaging.', '.\\Images\\ProductsImages\\p10cat1.jpg', 'on stock'),
(13, 2, 'Ariana Grande Ari Eau de Parfum Spray for Women\r\n', '60.15', 1, '45.07', 'Ari by Ariana Grande for Women\r\n3.4 oz Eau de Parfum Spray\r\nAriana Grande\r\nThe base of this scent contains musk, woods and marshmallow accord\r\n', '.\\Images\\ProductsImages\\p1cat2.jpg', 'on stock'),
(14, 2, 'VERSACE Eros Eau De Parfum Spray for Women\r\n', '99.99', 0, '0.00', 'Notes consist of jasmine sambac, cedar, labdanum, aquatic green accord, peony, brown sugar accord, mint leaves, pink pepper, limone primo fiore\r\nUsed for fragrance, mainly for women\r\nFor casual use, with good fragrance\r\nThe package dimension of the product is 4\"L x 5\"W x 4\"H\r\n', '.\\Images\\ProductsImages\\p2cat2.jpg', 'on stock'),
(15, 2, 'Christian Dior J\'adore for Women Eau De Parfum Spray\r\n', '138.72', 0, '0.00', 'This product is made of high quality material.\r\nIt is recommended for romantic wear.\r\nThis Product Is Manufactured In France\r\nThe package dimension of the product is 2.5\"L x 2.5\"W x 7.2\"H\r\nFor the “volume” of the item which is 100 Milliliters, Item weight is 415 Grams; the weight mentioned includes the product with liquid, weight of bottle and boxes.\r\n', '.\\Images\\ProductsImages\\p3cat2.jpg', 'on stock'),
(16, 2, 'Women\'s Perfume by Elizabeth Taylor, Eau de Parfum Spray\r\n', '20.48', 0, '0.00', 'Packaged in an elegant 3.3 ounce bottle.\r\nPerfect for a romantic getaway or casual day at work.\r\nLaced with orchid peony and musk\r\nMade for the feminine and alluring woman.\r\nSwirls of floral notes\r\nPackaging for this product may vary from that shown in the image above.\r\nThis item is not for sale in Catalina Island.\r\n', '.\\Images\\ProductsImages\\p4cat2.jpg', 'on stock'),
(17, 2, 'Ariana Grande Cloud Eau de Parfum Spray\r\n', '55.99', 0, '0.00', 'Ariana Grande fragrance Cloud is the uplifting new scent that imbues a thoughtful, artistic expression of positivity and happiness from Ariana to her fans.\r\nThis addictive scent opens with a dreamy blend of alluring lavender blossom, forbidden juicy Pear and mouth-watering bergamot.\r\nThe heart of the fragrance is a whipped touch of creme de coconut, indulgent praline and exotic, vanilla orchid. Sensual musk\'s and creamy woods add cashmere like feel that seduces the senses.\r\nTop: lavender blossom juicy Pear bergamot\r\nHeart: creme de coconut indulgent praline vanilla orchid\r\nDry down: sensual musk\'s creamy blond woods\r\nNote: Apply to pulse points: wrist, chest and neck.\r\n', '.\\Images\\ProductsImages\\p5cat2.jpg', 'on stock'),
(18, 2, 'Versace Versace Dylan Blue Pour Femme\r\n', '88.00', 1, '45.00', 'Versace Dylan Blue Pour Femme.\r\n3.4 oz Eau de Parfum Spray.\r\nVersace.\r\n', '.\\Images\\ProductsImages\\p6cat2.jpg', 'on stock'),
(19, 2, 'Dolce And Gabanna Dolce Garden for Women Eau De Parfum Spray\r\n', '73.00', 0, '0.00', 'This item is not a tester.\r\nPackaging may vary.\r\nBeauty and Personal care product.\r\nCountry of origin is United States.\r\n', '.\\Images\\ProductsImages\\p7cat2.jpg', 'on stock'),
(20, 2, 'Chânél Coco Mademoiselle For Women Eau de Parfum Spray\r\n', '120.60', 0, '0.00', 'Launched by the design house of chanel\r\nThis oriental floral fragrance has a blend of lemon, bergamot, orange, rose, jasmine, tonka bean, vanilla, patchouli and musk\r\nKeeps you all day fresh\r\nRecommended for casual wear\r\nLong lasting.\r\n', '.\\Images\\ProductsImages\\p8cat2.jpg', 'on stock'),
(21, 2, 'Victoria\'s Secret Tease Dreamer for Women Eau de Parfum Spray\r\n', '41.99', 0, '0.00', 'Tease Dreamer by Victoria\'s Secret is a Aromatic fragrance for women\r\nThis women’s aromatic fragrance incorporates iconic scents from southern california\r\nNotes: Bronzed Coconut, Ocean Salt and California Sun\r\nThe result is a blend of salty, sweet, tropical and milky aromatic textures\r\nRecommended for daily wear\r\n', '.\\Images\\ProductsImages\\p9cat2.jpg', 'on stock'),
(22, 2, 'Salvatore Ferragamo Signorina Eau de Parfum Spray for Women\r\n', '60.40', 0, '0.00', 'Signora is a celebration of chic girls with a sophisticated, subtly cheeky and fresh scent signature\r\nA new fragrance creation with the elegant and all Italian style by Salvatore Ferragamo\r\nA fragrance inspired by the strong bond between Salvatore Ferragamo and trendy feminine young ladies with timeless modernity, creativity and a hint of audacity\r\n', '.\\Images\\ProductsImages\\p10cat2.jpg', 'on stock'),
(33, 4, 'NEW Atomy Absolute Cell Active Skin care set\r\n', '194.90', 0, '0.00', 'The high-purity refining technology developed at the end of the long-term research of the Korea Atomic Energy Research Institute\r\nUnique technique of only Kolma BNH Co., Ltd. which extracts effective ingredient from cleanly grown raw herb\r\nImproves skin absorption by micro-degrading active ingredients using microbial enzymes\r\nWater soluble and oil soluble active ingredients in one capsule are stabilized at the same time.\r\n', '.\\Images\\ProductsImages\\p1cat1.jpg', 'on stock'),
(34, 4, 'Farmacy Honey Halo Ceramide Face Moisturizer Cream -Hydrating Facial Lotion for Dry Skin\r\n', '43.99', 0, '0.00', 'Hydrates and Soothes: The face moisturizer for women and men is made with antioxidant-rich, ultra-hydrating buckwheat honey that renews the skin’s appearance for a dewy, healthy-looking glow.\r\nLocks in Moisture: Honey Halo facial moisturizer is packed with potent plant-based ceramides which replenish the skin barrier. Shea butter and vitamin E lock in moisture to prevent dry skin from returning.\r\nPlumps Skin: The face cream also features fig fruit extract, added to leave skin smooth and supple.\r\nHow to Use: Farmacy moisturizers for dry skin can be used morning or night (ideally both). Just gently apply to a clean face and be sure to avoid direct contact with the eyes.\r\nThe Farmacy Way: Our goal is simple. We want to bring out the best version of your radiant self with the best possible, naturally derived ingredients. Each women\'s skincare and beauty product we craft uses cutting-edge science to harness the healing powers of ingredients that Mother Nature has been so kind as to provide for us.\r\n', '.\\Images\\ProductsImages\\p2cat1.jpg', 'on stock'),
(35, 4, 'Farmacy Cheer Up Brightening Vitamin C Eye Cream with Hyaluronic Acid', '42.75', 0, '0.00', 'The Farmacy Way: Our goal is simple. We want to bring out the best version of your radiant self with the best possible, naturally derived ingredients. Each women\'s skincare and beauty product we craft uses cutting-edge science to harness the healing powers of ingredients that Mother Nature has been so kind as to provide for us.\r\nHealthy Appearance: The robust under eye cream treats the entire area around the eye minimizing signs of aging and stress such as dark circles and fine lines\r\nInstant Radiance: Hyaluronic acid and three types of vitamin c, including acerola cherry, rejuvenate the eye contour and help reduce the appearance of dark circles.\r\nFast Absorbing: Cheer Up Anti Aging Eye Cream Quickly Sinks Into Skin And Doesn’T Pile Under Makeup. The Clean Formula Delivers Long-Lasting Hydration And Is Completely Fragrance Free.\r\nHow To Use: Begin And End Every Day With A Small Amount Above And Around Your Eyelids And Under Eyes. Smooth The Cream Gently With Inward Sweeping Motion To Avoid Stretching Skin. You May Apply To Brow Bone For Additional Radiance', '.\\Images\\ProductsImages\\p3cat4.jpg', 'on stock'),
(36, 4, 'Blue Sage Agave Aqua Hydra-Gel Facial Moisturizer ', '21.85', 1, '28.00', 'NATURAL WATER BASED HYDRATION: Use this daily gel moisturizer made with natural and organic ingredients to intensely hydrate dry skin. It\'s watery, bouncy and absorbs super fast.\r\nPROTECT YOUR SKIN: The Agave Stem Cells lock in that moisture, leaving skin feeling softer longer, and stabilizing skin to better defend against aging environmental stressors. Also made with Bamboo Extract which helps fight free radicals and reduces melanin production fading dark spots.\r\nANTI-AGING INGREDIENTS: Formulated with Propolis, Royal Jelly, and Honey, which will nourish skin with B-Vitamins, Peptides, Trace Minerals and Enzymes.\r\nDIRECTIONS: Use anytime you feel you need a hit of hydration by applying this moisturizer in a light circular motion all over the face and neck. Apply after cleansers, toners, serums and any other treatments. Works great under makeup too.\r\nWHO IS BLUE SAGE: We’re here to bring cool and natural skin care to Amazon, focused on formulating products for modern day life to help protect your skin against pollution and environmental stressors. Our products are made in the USA & are free of parabens and dyes, and are never cruel to animals.\r\n', '.\\Images\\ProductsImages\\p4cat4.jpg', 'on stock'),
(37, 4, 'New York Biology Dead Sea Mud Mask for Face and Body ', '16.95', 0, '0.00', 'BEST HOLIDAY GIFT GUIDE: works for all skin types, including dry, normal, oily, combination, sensitive, and irritated. This daily acne treatment has been designed to be highly effective yet gentle enough for everyday use and is a great gift for the holidays 2021.\r\nMINERAL-INFUSED Clarifying Mud Mask is based on an advanced formula composed of Dead Sea mineral mud, aloe vera, calendula oil, Vitamin E and Jojoba oil that gently purifies and cleans clogged pores.\r\nPURE DEAD SEA MUD helps cleanse the skin and provide a soothing sensation. Rich in minerals, it aids skin renewal, creating a gentle exfoliation effect that removes excess oil, toxins, and dead skin cells for a softer feel and radiant glow.\r\nREDUCES PORES & ABSORBS EXCESS OIL our Spa Quality Mud removes dead skin cells and toxins to reveal fresh, soft skin and is also known to stimulate blood circulation.\r\nOUR DEAD SEA FACIAL MASK is made with high quality ingredients and is alcohol, parabens, sulfates free and Cruelty Free.\r\n', '.\\Images\\ProductsImages\\p5cat4.jpg', 'on stock'),
(38, 4, 'Hyaluronic Acid\r\n', '20.00', 0, '0.00', 'It\'s easy to forget that standard moisturizers don\'t do much to actually hydrate the skin (they\'re mostly designed to lock in what\'s already there), so incorporating a hyaluronic acid is key to a supple complexion. Hyaluronic acid is naturally produced by your body, but most can use the extra boost from a well-formulated serum. The Ordinary\'s is a cult favorite.\r\n', '.\\Images\\ProductsImages\\p6cat4.png', 'on stock'),
(39, 4, 'Glow screen Sunscreen SPF 40\r\n', '35.99', 0, '0.00', 'A good skincare routine isn\'t complete without a SPF that protects from UVA/UVB damage—but Super goop outdid themselves with a formulation that doesn\'t just protect your face, it also treats it with hyaluronic acid and B5 (for hydration), sea lavender (anti-oxidant protection) and cocoa peptides (to protect against blue light damage). And the glow it gives? Major.\r\n', '.\\Images\\ProductsImages\\p7cat4.jpg', 'on stock'),
(40, 4, 'Sight C-er Vitamin C Concentrate', '42.00', 0, '0.00', 'As far as brightening goes, it is essential to have a good Vitamin C in your arsenal. Wander Beauty\'s is not just expertly formulated with squalane, hyaluronic acid, and niacinimide, but it is also packaged with an airless component, so your precious plumping and perkifying juice doesn\'t oxidize. This way you can correct, protect, and prevent damage to your complexion without giving it a further thought.\r\n', '.\\Images\\ProductsImages\\p8cat4.jpg', 'on stock'),
(41, 4, 'Hyaluronic Acid Face Moisturizer\r\n', '39.99', 0, '0.00', 'A simple formulation of mineralizing thermal water and hyaluronic acid delivers hydration, but also gently fortifies the skin barrier. Sure, it\'s fabulous for the most sensitive of skins, but great if you need a little moisture too.\r\n', '.\\Images\\ProductsImages\\p9cat4.jpg', 'on stock'),
(42, 4, 'Squalane + Marine Algae Eye Cream', '52.69', 0, '0.00', 'Typically speaking, some of the first signs of aging crop up around the eyes. This hydrating formulation plumps up and decreases the appearance of fine lines within a week. What could be better than that?\r\n', '.\\Images\\ProductsImages\\p10cat4.jpg', 'on stock'),
(49, 3, 'Belloccio\'s Professional Cosmetic Airbrush Makeup Foundation', '11.25', 1, '25.00', 'Fast, easy and flawless results in minutes!\r\nRevolutionary water-based foundation allows your naturally beautiful skin to show through - without the imperfections!\r\nHygienic Application\r\nIt instantly conceals and diminishes unwanted imperfections\r\nThe Belloccio Airbrush applies makeup in a fine mist that sits evenly on your skin and does not cake or clog pores\r\n', '.\\Images\\ProductsImages\\p1cat3.jpg', 'on stock'),
(50, 3, 'IT Cosmetics Your Skin But Better CC+ Airbrush Perfecting Powder\r\n', '25.00', 1, '50.00', 'YOUR SKIN BUT BETTER - This sheer-to-full coverage finishing powder transforms the look of your skin with a veil of optical-blurring pigments that camouflage pores, dark spots and other imperfections.\r\nAIRBRUSHED RESULTS - Your Skin But Better CC+ Airbrush Perfecting Powder delivers a skin-softening, flawless effect in 30 seconds! The talc-free formula won’t settle into fine lines or pores—for airbrushed results, every time.\r\nANTI-AGING INGREDIENTS - Our pressed powder is formulated with skin-loving hydrolyzed collagen, hyaluronic acid, niacin, hydrolyzed silk, and peptides.\r\n', '.\\Images\\ProductsImages\\p2cat3.jpg', 'on stock'),
(51, 3, 'Maybelline New York Sky High Washable Mascara', '70.00', 0, '0.00', 'Sky high lash impact from every angle, full volume meets limitless length\r\nMaybelline Lash Sensational Sky High mascara\'s exclusive flex tower mascara brush bends to volumize and extend every single lash from root to tip\r\nThis Maybelline volumizing and lengthening mascara formula is infused with bamboo Extract and fibers for long, full lashes that never get weighed down\r\nMaybelline New York\'s Lash Sensational Sky High mascara is available in washable mascara and waterproof mascara formulas\r\nMaybelline mascara is allergy tested, Ophthalmologist tested, suitable for sensitive eyes and contact lens wearers, removes easily\r\n', '.\\Images\\ProductsImages\\p3cat3.jpg', 'on stock'),
(52, 3, 'M. Asam Magic Finish Make-up Mousse – 4in1 Primer\r\n', '55.80', 0, '0.00', 'MAGIC FINISH Make-up Mousse makes small miracles come true. The 4-in-1 formula means primer, foundation, concealer, and powder are done in one easy step that that leaves skin looking radiant and natural all day long. The light and silky consistency of this mousse looks and feels like a flawless second skin.\r\nWHAT IT DOES: 4-in-1 Primer, Make-up, Powder & Concealer covers imperfections, blurs & smooths skin Silky, mousse-like texture applies easily and leaves skin looking flawless, natural and mattified.\r\nWHO IT\'S FOR: Suitable for All Skin Types, and almost all light-medium skin tone. Pigments automatically adjust to most light-to-medium skin tones.\r\n', '.\\Images\\ProductsImages\\p4cat3.jpg', 'on stock'),
(53, 3, 'AMUSE CHOU VELVET Soft Matt Korean Makeup Vegan 01 BOKSOONGA CHOU\r\n', '20.70', 0, '0.00', 'Innovative comfort fixing Innovative comfort fixing technology not only gives long-lasting color but also makes your lips comfy without dryness and enables blurring makeup. Gliding on lips softly as choux cream, color pigment adheres to lips fast, and elastomer gel gives blur effects on it.\r\nLight choux cream texture The light choux cream texture glides softly, filling up all the wrinkles of lips. The texture is light as air, moisturizing inside, and fuzzy outside.\r\n', '.\\Images\\ProductsImages\\p5cat3.jpg', 'on stock'),
(54, 3, 'NYX PROFESSIONAL MAKEUP That\'s The Point Liquid Eyeliner\r\n', '22.00', 0, '0.00', 'Liquid Eyeliner Pen: Define your eyes with NYX Professional Makeup That\'s The Point Eyeliner; This collection of rich black, satin matte finished liquid eyeliners feature felt tips for even application to lash lines for winged eyeliner looks\r\nAll About The Tips: These black liquid eyeliner pens features seven incredible felt tips; From paddle shaped to small and sharply angled, each pen has an entirely unique applicator for achieving maximum precision across an eclectic range of liner looks\r\n', '.\\Images\\ProductsImages\\p6cat3.jpg', 'on stock'),
(55, 3, 'Garnier SkinActive Micellar Cleansing Water, For Waterproof Makeup\r\n', '70.40', 0, '0.00', 'GARNIER MICELLAR CLEANSING WATER FOR WATERPROOF MAKEUP: Use this gentle yet powerful makeup remover to remove stubborn waterproof makeup. Safe for use in the eye area, and for removing longwear lipsticks, while leaving skin clean and refreshed- never dry.\r\nMICELLAR WATER IS EFFECTIVE YET GENTLE: It\'s simple, micellar cleansing water lifts away dirt, makeup, and excess oil, all in just a few swipes. No rinsing, no harsh rubbing- just refreshed skin, and a face washed clean and cleared of impurities.\r\n', '.\\Images\\ProductsImages\\p7cat3.jpg', 'on stock'),
(56, 3, 'Lip Gloss by Almay, Non-Sticky Lip Makeup', '58.60', 0, '0.00', '200 Angelic\r\nHigh shine finish\r\nFlocked applicator provides even color\r\nAvailable in 8 shades\r\nDermatologist tested\r\n', '.\\Images\\ProductsImages\\p8cat3.jpg', 'on stock'),
(57, 3, 'Honest Beauty Deep Hydration Face Cream\r\n', '12.70', 0, '0.00', 'New look, same great formula; packaging may vary\r\nSoften + condition skin\r\nSupport skin’s natural moisture barrier\r\nHypoallergenic + Dermatologist Tested Non-comedogenic\r\nCruelty free\r\n100% tree-free paper carton\r\nMADE WITH: Daikon Radish Seed Oil + Baobab Seed Oil + Shea Butter\r\nMADE WITHOUT: Parabens, Phthalates, PEGs, Dyes, Mineral Oil, Synthetic Fragrances\r\n', '.\\Images\\ProductsImages\\p9cat3.jpg', 'on stock'),
(58, 3, 'Honest Beauty Organic Beauty Facial Oil \r\n', '44.80', 0, '0.00', 'New look, same great formula; packaging may vary\r\nMultitasking blend of 8 organic fruit plus seed oils\r\nNourish and replenish skin\r\nDermatologist Tested plus Hypoallergenic\r\nVegan plus Cruelty free\r\n100% tree-free paper carton\r\nMADE WITH: Avocado Oil plus Apricot Oil plus Jojoba Oil\r\nMADE WITHOUT: Parabens, Dyes, Silicones, Paraffins, Synthetic fragrances\r\n', '.\\Images\\ProductsImages\\p10cat3.jpg', 'on stock');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(100) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` int(22) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `datee` date NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `is_delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `mobile`, `pass`, `datee`, `is_admin`, `is_delete`) VALUES
(1, 'roa', 'mohammad', 'rooayaseen@gmail.com', 2147483333, 'A12*', '2000-11-11', 1, 0),
(2, 'sara', 'kteifan', 'sara@gmail.com', 1324567987, 'SaraKteifan*99', '1999-09-09', 1, 0),
(3, 'Ghufran', 'Almomani', 'ghufran@gmail.com', 214748567, 'Abcd*1234', '1998-01-28', 0, 0),
(4, 'Maha', 'Kteifan', 'mahakteifan@gmail.com', 123456789, 'MahaMaha*99', '0000-00-00', 0, 1),
(5, 'Maha', 'Kteifan', 'mahakteifan@gmail.com', 123456789, 'MahaMaha*99', '0000-00-00', 0, 1),
(6, 'Saja', 'Kteifan', 'mahakteifan@gmail.com', 2147483647, 'MahaMaha*99', '0000-00-00', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
