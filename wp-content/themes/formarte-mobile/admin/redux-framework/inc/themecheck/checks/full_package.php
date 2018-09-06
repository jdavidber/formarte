<?php

    class Redux_Full_Package implements themecheck {
        protected $error = array();

        function check( $php_files, $css_files, $other_files ) {

            $ret = true;

            $check = Redux_ThemeCheck::get_instance();
            $redux = $check::get_redux_details( $php_files );

            if ( $redux ) {

                $blacklist = array(
                    '.tx'                    => __( 'Redux localization utilities', 'nightly-mobile' ),
                    'bin'                    => __( 'Redux Resting Diles', 'nightly-mobile' ),
                    'codestyles'             => __( 'Redux Code Styles', 'nightly-mobile' ),
                    'tests'                  => __( 'Redux Unit Testing', 'nightly-mobile' ),
                    'class.redux-plugin.php' => __( 'Redux Plugin File', 'nightly-mobile' ),
                    'bootstrap_tests.php'    => __( 'Redux Boostrap Tests', 'nightly-mobile' ),
                    '.travis.yml'            => __( 'CI Testing FIle', 'nightly-mobile' ),
                    'phpunit.xml'            => __( 'PHP Unit Testing', 'nightly-mobile' ),
                );

                $errors = array();

                foreach ( $blacklist as $file => $reason ) {
                    checkcount();
                    if ( file_exists( $redux['parent_dir'] . $file ) ) {
                        $errors[ $redux['parent_dir'] . $file ] = $reason;
                    }
                }

                if ( ! empty( $errors ) ) {
                    $error = '<span class="tc-lead tc-required">REQUIRED</span> ' . __( 'It appears that you have embedded the full Redux package inside your theme. You need only embed the <strong>ReduxCore</strong> folder. Embedding anything else will get your rejected from theme submission. Suspected Redux package file(s):', 'nightly-mobile' );
                    $error .= '<ol>';
                    foreach ( $errors as $key => $e ) {
                        $error .= '<li><strong>' . $e . '</strong>: ' . $key . '</li>';
                    }
                    $error .= '</ol>';
                    $this->error[] = '<div class="redux-error">' . $error . '</div>';
                    $ret           = false;
                }
            }

            return $ret;
        }

        function getError() {
            return $this->error;
        }
    }

    $themechecks[] = new Redux_Full_Package();