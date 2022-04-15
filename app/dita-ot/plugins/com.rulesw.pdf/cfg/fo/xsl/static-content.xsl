<?xml version='1.0'?>

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:fo="http://www.w3.org/1999/XSL/Format"
    version="2.0">


<!--Body Headers-->
    <xsl:template name="insertBodyFirstHeader">
        <fo:static-content flow-name="first-body-header">
            <fo:block xsl:use-attribute-sets="__body__first__header">
                <!--<xsl:call-template name="getVariable">
                    <xsl:with-param name="params">
                        <prodname>
                            <xsl:value-of select="$productName">
                        </prodname>
                    </xsl:with-param>
                </xsl:call-template>-->
            </fo:block>
        </fo:static-content>
    </xsl:template>

    <xsl:template name="insertBodyOddHeader">
        <fo:static-content flow-name="odd-body-header">
            <fo:block xsl:use-attribute-sets="__body__odd__header">
                <!--Header logo image body
                <fo:inline xsl:use-attribute-sets="__header__image">
                    <fo:external-graphic src="url(Customization/OpenTopic/common/artwork/logo.png)"/>
                </fo:inline>-->
                <!--Chapter title in header-->
                <!--<xsl:call-template name="getVariable">
                    <xsl:with-param name="id" select="'Body odd header'"/>
                    <xsl:with-param name="params">
                        <heading>
                            <fo:inline xsl:use-attribute-sets="__body__odd__header__heading">
                                <fo:retrieve-marker retrieve-class-name="current-header"/>
                            </fo:inline>
                        </heading>
                    </xsl:with-param>
                </xsl:call-template>-->
            </fo:block>
        </fo:static-content>
    </xsl:template>

    <xsl:template name="insertBodyEvenHeader">
        <fo:static-content flow-name="even-body-header">
            <fo:block xsl:use-attribute-sets="__body__even__header">
                <!--header image in body pages
                <fo:inline xsl:use-attribute-sets="__header__image">
                    <fo:external-graphic src="url(Customization/OpenTopic/common/artwork/logo.png)"/>
                </fo:inline>-->
                <!--Chapter title in header-->
                <!--<xsl:call-template name="getVariable">
                    <xsl:with-param name="id" select="'Body even header'"/>
                    <xsl:with-param name="params">
                        <heading>
                            <fo:inline xsl:use-attribute-sets="__body__odd__header__heading">
                                <fo:retrieve-marker retrieve-class-name="current-header"/>
                            </fo:inline>
                        </heading>
                    </xsl:with-param>
                </xsl:call-template>-->
            </fo:block>
        </fo:static-content>
    </xsl:template>
    
    <xsl:template name="insertBodyLastHeader">
        <fo:static-content flow-name="last-body-header">
            <fo:block xsl:use-attribute-sets="__body__last__header">
                <!--header image in body pages
                <fo:inline xsl:use-attribute-sets="__header__image">
                    <fo:external-graphic src="url(Customization/OpenTopic/common/artwork/logo.png)"/>
                </fo:inline>-->
                <!--Chapter title in header-->
                <!--<xsl:call-template name="getVariable">
                    <xsl:with-param name="id" select="'Body even header'"/>
                    <xsl:with-param name="params">
                        <heading>
                            <fo:inline xsl:use-attribute-sets="__body__odd__header__heading">
                                <fo:retrieve-marker retrieve-class-name="current-header"/>
                            </fo:inline>
                        </heading>
                    </xsl:with-param>
                </xsl:call-template>-->
            </fo:block>
        </fo:static-content>
    </xsl:template>
    

<!--TOC Headers-->
     <xsl:template name="insertTocEvenHeader">
        <fo:static-content flow-name="even-toc-header">
            <fo:block xsl:use-attribute-sets="__toc__even__header">
                <!--logo in header
                <fo:inline xsl:use-attribute-sets="__header__image">
                    <fo:external-graphic src="url(Customization/OpenTopic/common/artwork/logo.png)"/>
                </fo:inline>-->
                <!--Chapter title in header-->
                <!--<xsl:call-template name="getVariable">
                    <xsl:with-param name="id" select="'Toc even header'"/>
                        <xsl:with-param name="params">
                        <title>
                            <xsl:value-of select="$bc.bookTitle"/>
                        </title>
                        
                        <prodname>
                            <xsl:value-of select="$productName"/>
                        </prodname>
                        <heading>
                            <fo:inline xsl:use-attribute-sets="__body__even__header__heading">
                                <fo:retrieve-marker retrieve-class-name="current-header"/>
                            </fo:inline>
                        </heading>
                        <pagenum>
                            <fo:inline xsl:use-attribute-sets="__toc__even__header__pagenum">
                                <fo:page-number/>
                            </fo:inline>
                        </pagenum>
                    </xsl:with-param>
                </xsl:call-template>-->
            </fo:block>
        </fo:static-content>
    </xsl:template>

    <xsl:template name="insertTocOddHeader">
        <fo:static-content flow-name="odd-toc-header">
            <fo:block xsl:use-attribute-sets="__toc__odd__header">
                <!--header logo in Toc Odd Pages
                <fo:inline xsl:use-attribute-sets="__header__image">
                    <fo:external-graphic src="url(Customization/OpenTopic/common/artwork/logo.png)"/>
                </fo:inline>-->
                <!--<xsl:call-template name="getVariable">
                    <xsl:with-param name="id" select="'Toc odd header'"/>
                    <xsl:with-param name="params">
                        <prodname>
                            <xsl:value-of select="$productName"/>
                        </prodname>
                        <heading>
                            <fo:inline xsl:use-attribute-sets="__body__odd__header__heading">
                                <fo:retrieve-marker retrieve-class-name="current-header"/>
                            </fo:inline>
                        </heading>
                        <pagenum>
                            <fo:inline xsl:use-attribute-sets="__toc__odd__header__pagenum">
                                <fo:page-number/>
                            </fo:inline>
                        </pagenum>
                    </xsl:with-param>
                </xsl:call-template>-->
            </fo:block>
        </fo:static-content>
    </xsl:template>

<!--Index headers-->
    <xsl:template name="insertIndexEvenHeader">
        <fo:static-content flow-name="even-index-header">
            <fo:block xsl:use-attribute-sets="__index__even__header">
                <fo:inline>
                    <fo:external-graphic src="url(Customization/OpenTopic/common/artwork/logo.png)"/>
                </fo:inline>            
                <xsl:call-template name="getVariable">
                    <xsl:with-param name="id" select="'Index even header'"/>
                    <xsl:with-param name="params">
                        <title>
                            <xsl:value-of select="$bc.bookTitle"/>
                        </title>
                        <!--
                        <prodname>
                            <xsl:value-of select="$productName"/>
                        </prodname>
                        <heading>
                            <fo:inline xsl:use-attribute-sets="__body__even__header__heading">
                                <fo:retrieve-marker retrieve-class-name="current-header"/>
                            </fo:inline>
                        </heading>
                        <pagenum>
                            <fo:inline xsl:use-attribute-sets="__index__even__header__pagenum">
                                <fo:page-number/>
                            </fo:inline>
                        </pagenum>
                        -->
                    </xsl:with-param>
                </xsl:call-template>
            </fo:block>
        </fo:static-content>
    </xsl:template>

    <xsl:template name="insertIndexOddHeader">
        <fo:static-content flow-name="odd-index-header">
            <fo:block xsl:use-attribute-sets="__index__odd__header">
                <!--logo image-->
                <fo:inline>
                    <fo:external-graphic src="url(Customization/OpenTopic/common/artwork/logo.png)"/>
                </fo:inline>
                <!--chapter title-->
                <xsl:call-template name="getVariable">
                    <xsl:with-param name="id" select="'Index odd header'"/>
                    <!--
                    <xsl:with-param name="params">
                        <prodname>
                            <xsl:value-of select="$productName"/>
                        </prodname>
                        <heading>
                            <fo:inline xsl:use-attribute-sets="__body__odd__header__heading">
                                <fo:retrieve-marker retrieve-class-name="current-header"/>
                            </fo:inline>
                        </heading>
                        <pagenum>
                            <fo:inline xsl:use-attribute-sets="__index__odd__header__pagenum">
                                <fo:page-number/>
                            </fo:inline>
                        </pagenum>
                    </xsl:with-param>
                    -->
                </xsl:call-template>

            </fo:block>
        </fo:static-content>
    </xsl:template>

<!--Body Footers -->
    <xsl:template name="insertBodyOddFooter">
        <fo:static-content flow-name="odd-body-footer">
            <fo:block xsl:use-attribute-sets="__body__odd__footer">
                <!--<xsl:call-template name="getVariable">
                    <xsl:with-param name="id" select="'Body odd footer'"/>
                    <xsl:with-param name="params">
                        <pagenum>
                            <fo:inline xsl:use-attribute-sets="__body__odd__footer__pagenum">
                                <fo:page-number/>
                            </fo:inline>
                        </pagenum>
                        <pubdate>
                            <xsl:value-of select="bc.pubDate"/>
                            <fo:leader xsl:use-attribute-sets="__hdrftr__leader"/>
                        </pubdate>
                        <copyright>
                            <xsl:value-of select="bc.copyYear"/>
                            <fo:leader xsl:use-attribute-sets="__hdrftr__leader"/>
                        </copyright>
                    </xsl:with-param>
                </xsl:call-template>-->
            </fo:block>
        </fo:static-content>
    </xsl:template>

    <xsl:template name="insertBodyEvenFooter">
        <fo:static-content flow-name="even-body-footer">
            <fo:block xsl:use-attribute-sets="__body__even__footer">
                <!--<xsl:call-template name="getVariable">
                    <xsl:with-param name="id" select="'Body even footer'"/>
                    <xsl:with-param name="params">
                        <pagenum>
                            <fo:inline xsl:use-attribute-sets="__body__odd__footer__pagenum">
                                <fo:page-number/>
                            </fo:inline>
                        </pagenum>
                        <pubdate>
                            <xsl:value-of select="bc.pubDate"/>
                            <fo:leader xsl:use-attribute-sets="__hdrftr__leader"/>
                        </pubdate>
                        <copyright>
                            <xsl:value-of select="bc.copyYear"/>
                            <fo:leader xsl:use-attribute-sets="__hdrftr__leader"/>
                        </copyright>
                    </xsl:with-param>
                </xsl:call-template>-->
            </fo:block>
        </fo:static-content>
    </xsl:template>

    <xsl:template name="insertBodyLastFooter">
        <fo:static-content flow-name="last-body-footer">
            <fo:block xsl:use-attribute-sets="__body__last__footer">
                <!--<xsl:call-template name="getVariable">
                    <xsl:with-param name="id" select="'Body even footer'"/>
                    <xsl:with-param name="params">
                        <pagenum>
                            <fo:inline xsl:use-attribute-sets="__body__odd__footer__pagenum">
                                <fo:page-number/>
                            </fo:inline>
                        </pagenum>
                        <pubdate>
                            <xsl:value-of select="bc.pubDate"/>
                            <fo:leader xsl:use-attribute-sets="__hdrftr__leader"/>
                        </pubdate>
                        <copyright>
                            <xsl:value-of select="bc.copyYear"/>
                            <fo:leader xsl:use-attribute-sets="__hdrftr__leader"/>
                        </copyright>
                    </xsl:with-param>
                </xsl:call-template>-->
            </fo:block>
        </fo:static-content>
    </xsl:template>

<!--TOC Footers -->
    <xsl:template name="insertTocEvenFooter">
        <fo:static-content flow-name="even-toc-footer">
            <fo:block xsl:use-attribute-sets="even__footer">
            <!--<fo:block xsl:use-attribute-sets="__toc__even__footer">-->
                <!--<xsl:call-template name="getVariable">
                    <xsl:with-param name="id" select="'Toc even footer'"/>
                    <xsl:with-param name="params">
                        <pagenum>
                            <fo:inline xsl:use-attribute-sets="__body__odd__footer__pagenum">
                                <fo:page-number/>
                            </fo:inline>
                        </pagenum>
                        <pubdate>
                            <xsl:value-of select="bc.pubDate"/>
                            <fo:leader xsl:use-attribute-sets="__hdrftr__leader"/>
                        </pubdate>
                        <copyright>
                            <xsl:value-of select="bc.copyYear"/>
                            <fo:leader xsl:use-attribute-sets="__hdrftr__leader"/>
                        </copyright>
                    </xsl:with-param>
                </xsl:call-template>-->
            </fo:block>
        </fo:static-content>
    </xsl:template>
    
    <xsl:template name="insertTocOddFooter">
        <fo:static-content flow-name="odd-toc-footer">
            <fo:block xsl:use-attribute-sets="odd__footer">
            <!--<fo:block xsl:use-attribute-sets="__toc__odd__footer">-->
                <!--<xsl:call-template name="getVariable">
                    <xsl:with-param name="id" select="'Toc odd footer'"/>
                    <xsl:with-param name="params">
                        <pagenum>
                            <fo:inline xsl:use-attribute-sets="__body__odd__footer__pagenum">
                                <fo:page-number/>
                            </fo:inline>
                        </pagenum>
                        <pubdate>
                            <xsl:value-of select="bc.pubDate"/>
                            <fo:leader xsl:use-attribute-sets="__hdrftr__leader"/>
                        </pubdate>
                        <copyright>
                            <xsl:value-of select="bc.copyYear"/>
                            <fo:leader xsl:use-attribute-sets="__hdrftr__leader"/>
                        </copyright>
                    </xsl:with-param>
                </xsl:call-template>-->
            </fo:block>
        </fo:static-content>
    </xsl:template>

<!--Index Footers -->
    <xsl:template name="insertIndexEvenFooter">
        <fo:static-content flow-name="even-index-footer">
            <fo:block xsl:use-attribute-sets="__index__even__footer">
                <!--<xsl:call-template name="getVariable">
                    <xsl:with-param name="id" select="'Index even footer'"/>
                    <xsl:with-param name="params">
                        <pagenum>
                            <fo:inline xsl:use-attribute-sets="__body__odd__footer__pagenum">
                                <fo:page-number/>
                            </fo:inline>
                        </pagenum>
                        <pubdate>
                            <xsl:value-of select="bc.pubDate"/>
                            <fo:leader xsl:use-attribute-sets="__hdrftr__leader"/>
                        </pubdate>
                        <copyright>
                            <xsl:value-of select="bc.copyYear"/>
                            <fo:leader xsl:use-attribute-sets="__hdrftr__leader"/>
                        </copyright>
                    </xsl:with-param>
                </xsl:call-template>-->
            </fo:block>
        </fo:static-content>
    </xsl:template>

    <xsl:template name="insertIndexOddFooter">
        <fo:static-content flow-name="odd-index-footer">
            <fo:block xsl:use-attribute-sets="__index__odd__footer">
                <!--<xsl:call-template name="getVariable">
                    <xsl:with-param name="id" select="'Index odd footer'"/>
                    <xsl:with-param name="params">
                        <pagenum>
                            <fo:inline xsl:use-attribute-sets="__body__odd__footer__pagenum">
                                <fo:page-number/>
                            </fo:inline>
                        </pagenum>
                        <pubdate>
                            <xsl:value-of select="bc.pubDate"/>
                            <fo:leader xsl:use-attribute-sets="__hdrftr__leader"/>
                        </pubdate>
                        <copyright>
                            <xsl:value-of select="bc.copyYear"/>
                            <fo:leader xsl:use-attribute-sets="__hdrftr__leader"/>
                        </copyright>
                    </xsl:with-param>
                </xsl:call-template>-->
            </fo:block>
        </fo:static-content>
    </xsl:template>


<!--Preface-->
    <xsl:template name="insertBackCoverOddFooter">
      <fo:static-content flow-name="odd-back-cover-footer">
        <fo:block xsl:use-attribute-sets="odd__footer__preface">
          <!--<xsl:call-template name="getVariable">
            <xsl:with-param name="id" select="'Preface odd footer'"/>
            <xsl:with-param name="params">
              <heading>
                <fo:inline xsl:use-attribute-sets="__body__odd__footer__heading">
                  <fo:retrieve-marker retrieve-class-name="current-header"/>
                </fo:inline>
              </heading>
              <pagenum>
                <fo:inline xsl:use-attribute-sets="__body__odd__footer__pagenum">
                  <fo:page-number/>
                </fo:inline>
              </pagenum>
            </xsl:with-param>
          </xsl:call-template>-->
        </fo:block>
      </fo:static-content>
    </xsl:template>

    <xsl:template name="insertBackCoverOddHeader">
      <fo:static-content flow-name="odd-back-cover-header">
        <fo:block xsl:use-attribute-sets="odd__header__preface">
          <!--<xsl:call-template name="getVariable">
            <xsl:with-param name="id" select="'Preface odd header'"/>
            <xsl:with-param name="params">
              <prodname>
                <xsl:value-of select="$productName"/>
              </prodname>
              <heading>
                <fo:inline xsl:use-attribute-sets="__body__odd__header__heading">
                  <fo:retrieve-marker retrieve-class-name="current-header"/>
                </fo:inline>
              </heading>
              <pagenum>
                <fo:inline xsl:use-attribute-sets="__body__odd__header__pagenum">
                  <fo:page-number/>
                </fo:inline>
              </pagenum>
            </xsl:with-param>
          </xsl:call-template>-->
        </fo:block>
      </fo:static-content>
    </xsl:template>
    
    <xsl:template name="insertPrefaceFirstFooter">
        <fo:static-content flow-name="first-body-footer">
            <fo:block xsl:use-attribute-sets="__body__first__footer">
    <!--            <xsl:call-template name="getVariable">
                    <xsl:with-param name="id" select="'Preface first footer'"/>
                    <xsl:with-param name="params">
                        <heading>
                            <fo:inline xsl:use-attribute-sets="__body__first__footer__heading">
                                <fo:retrieve-marker retrieve-class-name="current-header"/>
                            </fo:inline>
                        </heading>
                        <pagenum>
                            <fo:inline xsl:use-attribute-sets="__body__first__footer__pagenum">
                                <fo:page-number/>
                            </fo:inline>
                        </pagenum>
                    </xsl:with-param>
                </xsl:call-template>-->
            </fo:block>
        </fo:static-content>
    </xsl:template>
 
</xsl:stylesheet>