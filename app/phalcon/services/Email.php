<?php
/**
 * @package Millipede\Services
 * @author Maciej Trybuła <mtrybula@divante.pl>
 * @copyright 2018 Divante Sp. z o.o.
 * @license See LICENSE_DIVANTE.txt for license details.
 */

namespace Millipede\Services;

use Millipede\Api\Services\EmailInterface;

/**
 * Class Email
 */
class Email implements EmailInterface
{
    /**
     * @param string $to
     * @param string $message
     * @param string $subject
     *
     * @return bool
     */
    public function sendEmail(string $to, string $message, $subject = self::SUBJECT): bool
    {
        $headers = self::HEADER_MIME_VERSION . self::HEADER_CONTENT_TYPE . self::HEADER_FROM;

        return mail($to, $subject, $message, $headers);
    }

    /**
     * @param array $emails
     * @param string $message
     *
     * @return array
     */
    public function sendEmails(array $emails, $message = ''): array
    {
        $emailStatuses = [
            self::EMAIL_STATUS_SENT => [],
            self::EMAIL_STATUS_NOT_SENT => [],
        ];

        foreach ($emails as $email) {
            $this->sendEmail($email, $message) ? $emailStatuses[self::EMAIL_STATUS_SENT][] = $email
                : $emailStatuses[self::EMAIL_STATUS_NOT_SENT][] = $email;
        }

        return $emailStatuses;
    }

    /**
     * @param array $millipede
     *
     * @return string
     */
    public function prepareMessage(array $millipede): string
    {
        $message = '';
        $message .= "<table align ='center'>";

        $lastEmail = count($millipede) - 1;

        foreach ($millipede as $key => $email) {
            $message .= '<tr>';
            $message .= '<td>';
            $message .= '>>>>> ' . $email . ' >>>>>' . ($key !== $lastEmail ? PHP_EOL : '');
            $message .= '</td>';
            $message .= '</tr>';
        }

        $message .= '</table>';

        return $message;
    }
}
