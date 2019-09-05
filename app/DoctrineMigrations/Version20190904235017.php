<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190904235017 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, profile_id INT DEFAULT NULL, point_of_sale_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', slug VARCHAR(255) DEFAULT NULL, device_code VARCHAR(100) DEFAULT NULL, name VARCHAR(45) NOT NULL, last_name VARCHAR(45) DEFAULT NULL, web_site VARCHAR(200) DEFAULT NULL, dni VARCHAR(8) DEFAULT NULL, ruc VARCHAR(11) DEFAULT NULL, headline VARCHAR(144) DEFAULT NULL, about_me TEXT DEFAULT NULL, dob DATE DEFAULT NULL, address VARCHAR(150) DEFAULT NULL, phone VARCHAR(45) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, user_create INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, user_update INT DEFAULT NULL, last_access DATETIME DEFAULT NULL, reset_password_hash VARCHAR(100) DEFAULT NULL, reset_password_date DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT \'1\', UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), INDEX IDX_8D93D6496B7E9A73 (point_of_sale_id), INDEX FK_8D93D649CCFA12B8 (profile_id), UNIQUE INDEX email_UNIQUE (email), UNIQUE INDEX username_UNIQUE (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE friends (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, friend_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT \'1\', INDEX fk_friends_user1_idx (user_id), INDEX fk_friends_user2_idx (friend_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(45) DEFAULT NULL, name VARCHAR(100) DEFAULT NULL, slug VARCHAR(100) NOT NULL, group_rol VARCHAR(100) DEFAULT NULL, group_rol_tag VARCHAR(100) DEFAULT NULL, created_at DATETIME NOT NULL, user_create INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, user_update INT DEFAULT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE files (id INT AUTO_INCREMENT NOT NULL, pk_file_item INT NOT NULL, class_name VARCHAR(150) NOT NULL, mime_content_type VARCHAR(45) NOT NULL, file_type VARCHAR(45) NOT NULL, filter VARCHAR(100) NOT NULL, uniqid VARCHAR(45) DEFAULT NULL, name VARCHAR(150) NOT NULL, created_at DATETIME NOT NULL, user_create INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, user_update INT DEFAULT NULL, is_active TINYINT(1) DEFAULT \'1\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders_has_products (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, orders_id INT DEFAULT NULL, pdv_hash VARCHAR(20) DEFAULT NULL, quantity DOUBLE PRECISION NOT NULL, unit_price DOUBLE PRECISION DEFAULT NULL, INDEX fk_sales_has_products_orders1_idx (orders_id), INDEX fk_sales_has_products_product1_idx (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_history (id INT AUTO_INCREMENT NOT NULL, sales_id INT DEFAULT NULL, payment_type_id INT DEFAULT NULL, name VARCHAR(45) DEFAULT NULL, sub_total DOUBLE PRECISION DEFAULT NULL, discount DOUBLE PRECISION DEFAULT NULL, total DOUBLE PRECISION DEFAULT NULL, payment DOUBLE PRECISION DEFAULT NULL, change_back DOUBLE PRECISION DEFAULT NULL, payment_collected DOUBLE PRECISION DEFAULT NULL, received_date DATETIME NOT NULL, slug VARCHAR(150) DEFAULT NULL, created_at DATETIME NOT NULL, user_create INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, user_update INT DEFAULT NULL, is_active TINYINT(1) DEFAULT \'1\', INDEX IDX_3EF37EA1DC058279 (payment_type_id), INDEX fk_payment_history_sales1_idx (sales_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, point_of_sale_id INT DEFAULT NULL, payment_type_id INT DEFAULT NULL, code VARCHAR(45) DEFAULT NULL, ticket_type VARCHAR(45) DEFAULT NULL, name VARCHAR(150) NOT NULL, date_ticket DATETIME NOT NULL, slug VARCHAR(150) DEFAULT NULL, created_at DATETIME NOT NULL, user_create INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, user_update INT DEFAULT NULL, is_active TINYINT(1) DEFAULT \'1\', INDEX IDX_97A0ADA319EB6921 (client_id), INDEX IDX_97A0ADA36B7E9A73 (point_of_sale_id), INDEX IDX_97A0ADA3DC058279 (payment_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket_has_employee (ticket_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_8C2F733E700047D2 (ticket_id), INDEX IDX_8C2F733EA76ED395 (user_id), PRIMARY KEY(ticket_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket_has_services (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, ticket_id INT DEFAULT NULL, quantity INT NOT NULL, unit_price DOUBLE PRECISION DEFAULT NULL, sub_total DOUBLE PRECISION DEFAULT NULL, INDEX fk_ticket_has_services_ticket1_idx (ticket_id), INDEX fk_ticket_has_services_services1_idx (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sales_has_products (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, sales_id INT DEFAULT NULL, quantity DOUBLE PRECISION NOT NULL, unit_price DOUBLE PRECISION DEFAULT NULL, INDEX fk_sales_has_products_sales1_idx (sales_id), INDEX fk_sales_has_products_product1_idx (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sales (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, point_of_sale_id INT DEFAULT NULL, code VARCHAR(45) DEFAULT NULL, status INT DEFAULT NULL, total DOUBLE PRECISION DEFAULT NULL, name VARCHAR(150) NOT NULL, delivery_date DATETIME NOT NULL, slug VARCHAR(150) DEFAULT NULL, created_at DATETIME NOT NULL, user_create INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, user_update INT DEFAULT NULL, is_active TINYINT(1) DEFAULT \'1\', INDEX IDX_6B81704419EB6921 (client_id), INDEX IDX_6B8170446B7E9A73 (point_of_sale_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sales_has_employee (sales_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_D0B4822DA4522A07 (sales_id), INDEX IDX_D0B4822DA76ED395 (user_id), PRIMARY KEY(sales_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, point_of_sale_id INT DEFAULT NULL, code VARCHAR(45) DEFAULT NULL, status INT DEFAULT NULL, total DOUBLE PRECISION DEFAULT NULL, name VARCHAR(150) NOT NULL, delivery_date DATETIME NOT NULL, slug VARCHAR(150) DEFAULT NULL, created_at DATETIME NOT NULL, user_create INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, user_update INT DEFAULT NULL, is_active TINYINT(1) DEFAULT \'1\', INDEX IDX_E52FFDEE19EB6921 (client_id), INDEX IDX_E52FFDEE6B7E9A73 (point_of_sale_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders_has_employee (sales_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_5C504C1BA4522A07 (sales_id), INDEX IDX_5C504C1BA76ED395 (user_id), PRIMARY KEY(sales_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_type (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(45) DEFAULT NULL, name VARCHAR(45) DEFAULT NULL, slug VARCHAR(150) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE google_drive_file_count (id INT AUTO_INCREMENT NOT NULL, file_id VARCHAR(45) NOT NULL, count_share INT DEFAULT NULL, count_view INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE google_drive_file_vote (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, google_drive_file_id INT DEFAULT NULL, vote TINYINT(1) DEFAULT \'0\', created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT \'1\', INDEX fk_google_drive_file_like_google_drive_file1_idx (google_drive_file_id), INDEX fk_google_drive_file_like_user1_idx (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE google_drive_file (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, unique_id VARCHAR(50) NOT NULL, slug VARCHAR(150) NOT NULL, description TEXT DEFAULT NULL, file_id VARCHAR(45) NOT NULL, file_mime_type VARCHAR(250) DEFAULT NULL, file_mime_type_short VARCHAR(45) DEFAULT NULL, file_icon_link VARCHAR(250) DEFAULT NULL, file_name TEXT NOT NULL, file_name_original TEXT DEFAULT NULL, file_size VARCHAR(45) DEFAULT NULL, file_image VARCHAR(255) DEFAULT NULL, has_thumbnail TINYINT(1) DEFAULT \'0\' NOT NULL, count_share INT DEFAULT NULL, count_view INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT \'1\' NOT NULL, INDEX fk_google_drive_file_user_idx (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE report_pdv (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, pointofsale_opening_id INT DEFAULT NULL, name VARCHAR(45) DEFAULT NULL, slug VARCHAR(45) DEFAULT NULL, pdv_hash VARCHAR(20) DEFAULT NULL, stock_initial INT DEFAULT NULL, stock_orders DOUBLE PRECISION DEFAULT NULL, stock_sales DOUBLE PRECISION DEFAULT NULL, created_at DATETIME NOT NULL, user_create INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, user_update INT DEFAULT NULL, is_active TINYINT(1) DEFAULT \'1\', INDEX fk_report_pdv_product1_idx (product_id), INDEX fk_report_pdv_pointofsale_opening1_idx (pointofsale_opening_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE income_and_expenses (id INT AUTO_INCREMENT NOT NULL, pointofsale_opening_id INT DEFAULT NULL, name VARCHAR(45) DEFAULT NULL, slug VARCHAR(45) DEFAULT NULL, pdv_hash VARCHAR(20) DEFAULT NULL, opening_date DATETIME DEFAULT NULL, contents VARCHAR(45) DEFAULT NULL, amount DOUBLE PRECISION DEFAULT NULL, created_at DATETIME NOT NULL, user_create INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, user_update INT DEFAULT NULL, is_active TINYINT(1) DEFAULT \'1\', INDEX fk_report_pdv_pointofsale_opening1_idx (pointofsale_opening_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(45) DEFAULT NULL, name VARCHAR(100) NOT NULL, name_canonical VARCHAR(100) DEFAULT NULL, slug VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, user_create INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, user_update INT DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile_has_role (profile_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_F35F3084CCFA12B8 (profile_id), INDEX IDX_F35F3084D60322AC (role_id), PRIMARY KEY(profile_id, role_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unit (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) DEFAULT NULL, unit_value INT NOT NULL, slug VARCHAR(100) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, unit_id INT DEFAULT NULL, color_id INT DEFAULT NULL, code VARCHAR(7) DEFAULT NULL, name VARCHAR(150) NOT NULL, slug VARCHAR(150) DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, cost DOUBLE PRECISION DEFAULT NULL, reference VARCHAR(150) DEFAULT NULL, barcode VARCHAR(20) DEFAULT NULL, size VARCHAR(10) DEFAULT NULL, size_range VARCHAR(10) DEFAULT NULL, created_at DATETIME NOT NULL, user_create INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, user_update INT DEFAULT NULL, is_active TINYINT(1) DEFAULT \'1\', INDEX IDX_D34A04ADF8BD700D (unit_id), INDEX fk_product_category1_idx (category_id), INDEX fk_product_color1_idx (color_id), UNIQUE INDEX barcode_UNIQUE (barcode), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE color (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) DEFAULT NULL, prefix VARCHAR(45) DEFAULT NULL, slug VARCHAR(100) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, token VARCHAR(45) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_D044D5D4A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE settings (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(45) DEFAULT NULL, name VARCHAR(150) DEFAULT NULL, slug VARCHAR(150) DEFAULT NULL, class_name VARCHAR(150) NOT NULL, class_value VARCHAR(150) NOT NULL, created_at DATETIME NOT NULL, user_create INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, user_update INT DEFAULT NULL, is_active TINYINT(1) DEFAULT \'1\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE services (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, code VARCHAR(45) DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, name VARCHAR(150) NOT NULL, slug VARCHAR(150) DEFAULT NULL, created_at DATETIME NOT NULL, user_create INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, user_update INT DEFAULT NULL, is_active TINYINT(1) DEFAULT \'1\', INDEX fk_product_category1_idx (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, code VARCHAR(45) DEFAULT NULL, name VARCHAR(150) DEFAULT NULL, slug VARCHAR(150) DEFAULT NULL, type VARCHAR(45) DEFAULT NULL, created_at DATETIME DEFAULT NULL, user_create INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, user_update INT DEFAULT NULL, is_active TINYINT(1) DEFAULT \'1\', INDEX fk_category_category1_idx (category_id), UNIQUE INDEX code_UNIQUE (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE point_of_sale (id INT AUTO_INCREMENT NOT NULL, point_of_sale_id INT DEFAULT NULL, code VARCHAR(45) DEFAULT NULL, status INT DEFAULT NULL, pdv_hash VARCHAR(20) DEFAULT NULL, slug VARCHAR(100) NOT NULL, name VARCHAR(100) DEFAULT NULL, latitude NUMERIC(10, 8) DEFAULT NULL, longitude NUMERIC(11, 8) DEFAULT NULL, description TEXT DEFAULT NULL, address TEXT DEFAULT NULL, phone TINYTEXT DEFAULT NULL, created_at DATETIME NOT NULL, user_create INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, user_update INT DEFAULT NULL, is_active TINYINT(1) DEFAULT \'1\', INDEX fk_point_of_sale_point_of_sale1_idx (point_of_sale_id), UNIQUE INDEX code_UNIQUE (code), UNIQUE INDEX slug_UNIQUE (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE point_of_sale_has_category (point_of_sale_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_A82D93496B7E9A73 (point_of_sale_id), INDEX IDX_A82D934912469DE2 (category_id), PRIMARY KEY(point_of_sale_id, category_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE point_of_sale_has_user (point_of_sale_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_6D10130A6B7E9A73 (point_of_sale_id), INDEX IDX_6D10130AA76ED395 (user_id), PRIMARY KEY(point_of_sale_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pointofsale_opening (id INT AUTO_INCREMENT NOT NULL, point_of_sale_id INT DEFAULT NULL, name VARCHAR(45) DEFAULT NULL, slug VARCHAR(45) DEFAULT NULL, pdv_hash VARCHAR(20) DEFAULT NULL, opening_date DATETIME DEFAULT NULL, closing_date DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, user_create INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, user_update INT DEFAULT NULL, is_active TINYINT(1) DEFAULT \'1\', INDEX fk_report_point_of_sale1_idx (point_of_sale_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE point_of_sale_has_product (id INT AUTO_INCREMENT NOT NULL, point_of_sale_id INT DEFAULT NULL, product_id INT DEFAULT NULL, stock VARCHAR(11) DEFAULT NULL, INDEX fk_point_of_sale_has_product_point_of_sale1_idx (point_of_sale_id), INDEX fk_point_of_sale_has_product_product1_idx (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496B7E9A73 FOREIGN KEY (point_of_sale_id) REFERENCES point_of_sale (id)');
        $this->addSql('ALTER TABLE friends ADD CONSTRAINT FK_21EE7069A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE friends ADD CONSTRAINT FK_21EE70696A5458E8 FOREIGN KEY (friend_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE orders_has_products ADD CONSTRAINT FK_B27563E04584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE orders_has_products ADD CONSTRAINT FK_B27563E0CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE payment_history ADD CONSTRAINT FK_3EF37EA1A4522A07 FOREIGN KEY (sales_id) REFERENCES sales (id)');
        $this->addSql('ALTER TABLE payment_history ADD CONSTRAINT FK_3EF37EA1DC058279 FOREIGN KEY (payment_type_id) REFERENCES payment_type (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA319EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA36B7E9A73 FOREIGN KEY (point_of_sale_id) REFERENCES point_of_sale (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3DC058279 FOREIGN KEY (payment_type_id) REFERENCES payment_type (id)');
        $this->addSql('ALTER TABLE ticket_has_employee ADD CONSTRAINT FK_8C2F733E700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id)');
        $this->addSql('ALTER TABLE ticket_has_employee ADD CONSTRAINT FK_8C2F733EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ticket_has_services ADD CONSTRAINT FK_A282E7F6ED5CA9E6 FOREIGN KEY (service_id) REFERENCES services (id)');
        $this->addSql('ALTER TABLE ticket_has_services ADD CONSTRAINT FK_A282E7F6700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id)');
        $this->addSql('ALTER TABLE sales_has_products ADD CONSTRAINT FK_3E91ADD64584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE sales_has_products ADD CONSTRAINT FK_3E91ADD6A4522A07 FOREIGN KEY (sales_id) REFERENCES sales (id)');
        $this->addSql('ALTER TABLE sales ADD CONSTRAINT FK_6B81704419EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sales ADD CONSTRAINT FK_6B8170446B7E9A73 FOREIGN KEY (point_of_sale_id) REFERENCES point_of_sale (id)');
        $this->addSql('ALTER TABLE sales_has_employee ADD CONSTRAINT FK_D0B4822DA4522A07 FOREIGN KEY (sales_id) REFERENCES sales (id)');
        $this->addSql('ALTER TABLE sales_has_employee ADD CONSTRAINT FK_D0B4822DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE19EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE6B7E9A73 FOREIGN KEY (point_of_sale_id) REFERENCES point_of_sale (id)');
        $this->addSql('ALTER TABLE orders_has_employee ADD CONSTRAINT FK_5C504C1BA4522A07 FOREIGN KEY (sales_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE orders_has_employee ADD CONSTRAINT FK_5C504C1BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE google_drive_file_vote ADD CONSTRAINT FK_35D550BFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE google_drive_file_vote ADD CONSTRAINT FK_35D550BF77A02D92 FOREIGN KEY (google_drive_file_id) REFERENCES google_drive_file (id)');
        $this->addSql('ALTER TABLE google_drive_file ADD CONSTRAINT FK_148FFCAAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE report_pdv ADD CONSTRAINT FK_E3BCB36F4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE report_pdv ADD CONSTRAINT FK_E3BCB36F35C531AB FOREIGN KEY (pointofsale_opening_id) REFERENCES pointofsale_opening (id)');
        $this->addSql('ALTER TABLE income_and_expenses ADD CONSTRAINT FK_1B475D4935C531AB FOREIGN KEY (pointofsale_opening_id) REFERENCES pointofsale_opening (id)');
        $this->addSql('ALTER TABLE profile_has_role ADD CONSTRAINT FK_F35F3084CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE profile_has_role ADD CONSTRAINT FK_F35F3084D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADF8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD7ADA1FB5 FOREIGN KEY (color_id) REFERENCES color (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE services ADD CONSTRAINT FK_7332E16912469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C112469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE point_of_sale ADD CONSTRAINT FK_F7A7B1FA6B7E9A73 FOREIGN KEY (point_of_sale_id) REFERENCES point_of_sale (id)');
        $this->addSql('ALTER TABLE point_of_sale_has_category ADD CONSTRAINT FK_A82D93496B7E9A73 FOREIGN KEY (point_of_sale_id) REFERENCES point_of_sale (id)');
        $this->addSql('ALTER TABLE point_of_sale_has_category ADD CONSTRAINT FK_A82D934912469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE point_of_sale_has_user ADD CONSTRAINT FK_6D10130A6B7E9A73 FOREIGN KEY (point_of_sale_id) REFERENCES point_of_sale (id)');
        $this->addSql('ALTER TABLE point_of_sale_has_user ADD CONSTRAINT FK_6D10130AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pointofsale_opening ADD CONSTRAINT FK_4063FD336B7E9A73 FOREIGN KEY (point_of_sale_id) REFERENCES point_of_sale (id)');
        $this->addSql('ALTER TABLE point_of_sale_has_product ADD CONSTRAINT FK_63AAC6456B7E9A73 FOREIGN KEY (point_of_sale_id) REFERENCES point_of_sale (id)');
        $this->addSql('ALTER TABLE point_of_sale_has_product ADD CONSTRAINT FK_63AAC6454584665A FOREIGN KEY (product_id) REFERENCES product (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE friends DROP FOREIGN KEY FK_21EE7069A76ED395');
        $this->addSql('ALTER TABLE friends DROP FOREIGN KEY FK_21EE70696A5458E8');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA319EB6921');
        $this->addSql('ALTER TABLE ticket_has_employee DROP FOREIGN KEY FK_8C2F733EA76ED395');
        $this->addSql('ALTER TABLE sales DROP FOREIGN KEY FK_6B81704419EB6921');
        $this->addSql('ALTER TABLE sales_has_employee DROP FOREIGN KEY FK_D0B4822DA76ED395');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE19EB6921');
        $this->addSql('ALTER TABLE orders_has_employee DROP FOREIGN KEY FK_5C504C1BA76ED395');
        $this->addSql('ALTER TABLE google_drive_file_vote DROP FOREIGN KEY FK_35D550BFA76ED395');
        $this->addSql('ALTER TABLE google_drive_file DROP FOREIGN KEY FK_148FFCAAA76ED395');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4A76ED395');
        $this->addSql('ALTER TABLE point_of_sale_has_user DROP FOREIGN KEY FK_6D10130AA76ED395');
        $this->addSql('ALTER TABLE profile_has_role DROP FOREIGN KEY FK_F35F3084D60322AC');
        $this->addSql('ALTER TABLE ticket_has_employee DROP FOREIGN KEY FK_8C2F733E700047D2');
        $this->addSql('ALTER TABLE ticket_has_services DROP FOREIGN KEY FK_A282E7F6700047D2');
        $this->addSql('ALTER TABLE payment_history DROP FOREIGN KEY FK_3EF37EA1A4522A07');
        $this->addSql('ALTER TABLE sales_has_products DROP FOREIGN KEY FK_3E91ADD6A4522A07');
        $this->addSql('ALTER TABLE sales_has_employee DROP FOREIGN KEY FK_D0B4822DA4522A07');
        $this->addSql('ALTER TABLE orders_has_products DROP FOREIGN KEY FK_B27563E0CFFE9AD6');
        $this->addSql('ALTER TABLE orders_has_employee DROP FOREIGN KEY FK_5C504C1BA4522A07');
        $this->addSql('ALTER TABLE payment_history DROP FOREIGN KEY FK_3EF37EA1DC058279');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3DC058279');
        $this->addSql('ALTER TABLE google_drive_file_vote DROP FOREIGN KEY FK_35D550BF77A02D92');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649CCFA12B8');
        $this->addSql('ALTER TABLE profile_has_role DROP FOREIGN KEY FK_F35F3084CCFA12B8');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADF8BD700D');
        $this->addSql('ALTER TABLE orders_has_products DROP FOREIGN KEY FK_B27563E04584665A');
        $this->addSql('ALTER TABLE sales_has_products DROP FOREIGN KEY FK_3E91ADD64584665A');
        $this->addSql('ALTER TABLE report_pdv DROP FOREIGN KEY FK_E3BCB36F4584665A');
        $this->addSql('ALTER TABLE point_of_sale_has_product DROP FOREIGN KEY FK_63AAC6454584665A');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD7ADA1FB5');
        $this->addSql('ALTER TABLE ticket_has_services DROP FOREIGN KEY FK_A282E7F6ED5CA9E6');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE services DROP FOREIGN KEY FK_7332E16912469DE2');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C112469DE2');
        $this->addSql('ALTER TABLE point_of_sale_has_category DROP FOREIGN KEY FK_A82D934912469DE2');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496B7E9A73');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA36B7E9A73');
        $this->addSql('ALTER TABLE sales DROP FOREIGN KEY FK_6B8170446B7E9A73');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE6B7E9A73');
        $this->addSql('ALTER TABLE point_of_sale DROP FOREIGN KEY FK_F7A7B1FA6B7E9A73');
        $this->addSql('ALTER TABLE point_of_sale_has_category DROP FOREIGN KEY FK_A82D93496B7E9A73');
        $this->addSql('ALTER TABLE point_of_sale_has_user DROP FOREIGN KEY FK_6D10130A6B7E9A73');
        $this->addSql('ALTER TABLE pointofsale_opening DROP FOREIGN KEY FK_4063FD336B7E9A73');
        $this->addSql('ALTER TABLE point_of_sale_has_product DROP FOREIGN KEY FK_63AAC6456B7E9A73');
        $this->addSql('ALTER TABLE report_pdv DROP FOREIGN KEY FK_E3BCB36F35C531AB');
        $this->addSql('ALTER TABLE income_and_expenses DROP FOREIGN KEY FK_1B475D4935C531AB');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE friends');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE files');
        $this->addSql('DROP TABLE orders_has_products');
        $this->addSql('DROP TABLE payment_history');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE ticket_has_employee');
        $this->addSql('DROP TABLE ticket_has_services');
        $this->addSql('DROP TABLE sales_has_products');
        $this->addSql('DROP TABLE sales');
        $this->addSql('DROP TABLE sales_has_employee');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE orders_has_employee');
        $this->addSql('DROP TABLE payment_type');
        $this->addSql('DROP TABLE google_drive_file_count');
        $this->addSql('DROP TABLE google_drive_file_vote');
        $this->addSql('DROP TABLE google_drive_file');
        $this->addSql('DROP TABLE report_pdv');
        $this->addSql('DROP TABLE income_and_expenses');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE profile_has_role');
        $this->addSql('DROP TABLE unit');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE color');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE settings');
        $this->addSql('DROP TABLE services');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE point_of_sale');
        $this->addSql('DROP TABLE point_of_sale_has_category');
        $this->addSql('DROP TABLE point_of_sale_has_user');
        $this->addSql('DROP TABLE pointofsale_opening');
        $this->addSql('DROP TABLE point_of_sale_has_product');
    }
}
