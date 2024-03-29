<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240311142830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'INSERT INTO product (name, price) 
                    VALUES (\'Iphone\', 100),
                           (\'Наушники\', 20),
                           (\'Чехол\', 10)'
        );

    }

    public function down(Schema $schema): void
    {
        $this->addSql(
            'TRUNCATE TABLE product'
        );

    }
}
