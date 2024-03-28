<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240314172950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO tax (format, rate) VALUES (\'^DE\\\d{8}$\', 19)');
        $this->addSql('INSERT INTO tax (format, rate) VALUES (\'^IT\\\d{11}$\', 22)');
        $this->addSql('INSERT INTO tax (format, rate) VALUES (\'^FR\\\w{2}\\\d{9}$\', 20)');
        $this->addSql('INSERT INTO tax (format, rate) VALUES (\'^GR\\\w{2}\\\d{7}$\', 24)');

        $this->addSql('INSERT INTO coupon (name, type, value) VALUES (\'FIX-10\', \'FIX\', 10)');
        $this->addSql('INSERT INTO coupon (name, type, value) VALUES (\'PERCENT-20\', \'PERCENT\', 20)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('TRUNCATE TABLE tax');
        $this->addSql('TRUNCATE TABLE coupon');
    }
}
