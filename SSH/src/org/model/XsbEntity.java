package org.model;

import javax.persistence.*;
import java.util.Arrays;
import java.util.Date;

/**
 * Created by wujiacheng on 16/6/6.
 */
@Entity
@Table(name = "xsb", schema = "stuSys")
public class XsbEntity {
    private String xh;
    private String xm;
    private String xb;
    private Date cssj;
    private int zyId;
    private Integer zxf;
    private String bz;
    private byte[] zp;
    private ZybEntity zyb;

    public ZybEntity getZyb() {
        return zyb;
    }

    public void setZyb(ZybEntity zyb) {
        this.zyb = zyb;
    }

    @Id
    @Column(name = "XH", nullable = false, length = 6)
    public String getXh() {
        return xh;
    }

    public void setXh(String xh) {
        this.xh = xh;
    }

    @Basic
    @Column(name = "XM", nullable = false, length = 8)
    public String getXm() {
        return xm;
    }

    public void setXm(String xm) {
        this.xm = xm;
    }

    @Basic
    @Column(name = "XB", nullable = false, length = 45)
    public String getXb() {
        return xb;
    }

    public void setXb(String xb) {
        this.xb = xb;
    }

    @Basic
    @Column(name = "CSSJ", nullable = true)
    public Date getCssj() {
        return cssj;
    }

    public void setCssj(Date cssj) {
        this.cssj = cssj;
    }

    @Basic
    @Column(name = "ZY_ID", nullable = false)
    public int getZyId() {
        return zyId;
    }

    public void setZyId(int zyId) {
        this.zyId = zyId;
    }

    @Basic
    @Column(name = "ZXF", nullable = true)
    public Integer getZxf() {
        return zxf;
    }

    public void setZxf(Integer zxf) {
        this.zxf = zxf;
    }

    @Basic
    @Column(name = "BZ", nullable = true, length = 200)
    public String getBz() {
        return bz;
    }

    public void setBz(String bz) {
        this.bz = bz;
    }

    @Basic
    @Column(name = "ZP", nullable = true)
    public byte[] getZp() {
        return zp;
    }

    public void setZp(byte[] zp) {
        this.zp = zp;
    }

    @Override
    public boolean equals(Object o) {
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;

        XsbEntity xsbEntity = (XsbEntity) o;

        if (zyId != xsbEntity.zyId) return false;
        if (xh != null ? !xh.equals(xsbEntity.xh) : xsbEntity.xh != null) return false;
        if (xm != null ? !xm.equals(xsbEntity.xm) : xsbEntity.xm != null) return false;
        if (xb != null ? !xb.equals(xsbEntity.xb) : xsbEntity.xb != null) return false;
        if (cssj != null ? !cssj.equals(xsbEntity.cssj) : xsbEntity.cssj != null) return false;
        if (zxf != null ? !zxf.equals(xsbEntity.zxf) : xsbEntity.zxf != null) return false;
        if (bz != null ? !bz.equals(xsbEntity.bz) : xsbEntity.bz != null) return false;
        if (!Arrays.equals(zp, xsbEntity.zp)) return false;

        return true;
    }

    @Override
    public int hashCode() {
        int result = xh != null ? xh.hashCode() : 0;
        result = 31 * result + (xm != null ? xm.hashCode() : 0);
        result = 31 * result + (xb != null ? xb.hashCode() : 0);
        result = 31 * result + (cssj != null ? cssj.hashCode() : 0);
        result = 31 * result + zyId;
        result = 31 * result + (zxf != null ? zxf.hashCode() : 0);
        result = 31 * result + (bz != null ? bz.hashCode() : 0);
        result = 31 * result + Arrays.hashCode(zp);
        return result;
    }
}
