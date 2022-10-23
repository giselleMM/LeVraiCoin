<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221022144217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE picture_post (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, photo LONGBLOB NOT NULL, INDEX IDX_E56AE9184B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_tag (post_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_5ACE3AF04B89032C (post_id), INDEX IDX_5ACE3AF0BAD26311 (tag_id), PRIMARY KEY(post_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE picture_post ADD CONSTRAINT FK_E56AE9184B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE post_tag ADD CONSTRAINT FK_5ACE3AF04B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_tag ADD CONSTRAINT FK_5ACE3AF0BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DBAD26311');
        $this->addSql('DROP INDEX IDX_5A8A6C8DBAD26311 ON post');
        $this->addSql('ALTER TABLE post ADD sold_on DATETIME DEFAULT NULL, DROP tag_id');
        $this->addSql('ALTER TABLE question ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B6F7494EF675F31B ON question (author_id)');
        $this->addSql('ALTER TABLE response ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_3E7B0BFBF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3E7B0BFBF675F31B ON response (author_id)');
        $this->addSql('ALTER TABLE test CHANGE tag_id tag_id INT NOT NULL, CHANGE title title LONGTEXT NOT NULL, CHANGE description description LONGTEXT NOT NULL, CHANGE price price INT NOT NULL, CHANGE published_on published_on DATE NOT NULL');
        $this->addSql('ALTER TABLE user ADD admin VARBINARY(255) NOT NULL, ADD positive_note INT DEFAULT NULL, ADD negative_note INT DEFAULT NULL, DROP note');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture_post DROP FOREIGN KEY FK_E56AE9184B89032C');
        $this->addSql('ALTER TABLE post_tag DROP FOREIGN KEY FK_5ACE3AF04B89032C');
        $this->addSql('ALTER TABLE post_tag DROP FOREIGN KEY FK_5ACE3AF0BAD26311');
        $this->addSql('DROP TABLE picture_post');
        $this->addSql('DROP TABLE post_tag');
        $this->addSql('ALTER TABLE test CHANGE tag_id tag_id INT DEFAULT NULL, CHANGE title title VARCHAR(255) DEFAULT NULL, CHANGE description description LONGTEXT DEFAULT NULL, CHANGE price price INT DEFAULT NULL, CHANGE published_on published_on DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE response DROP FOREIGN KEY FK_3E7B0BFBF675F31B');
        $this->addSql('DROP INDEX IDX_3E7B0BFBF675F31B ON response');
        $this->addSql('ALTER TABLE response DROP author_id');
        $this->addSql('ALTER TABLE post ADD tag_id INT DEFAULT NULL, DROP sold_on');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DBAD26311 ON post (tag_id)');
        $this->addSql('ALTER TABLE user ADD note INT NOT NULL, DROP admin, DROP positive_note, DROP negative_note');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EF675F31B');
        $this->addSql('DROP INDEX IDX_B6F7494EF675F31B ON question');
        $this->addSql('ALTER TABLE question DROP author_id');
    }
}
