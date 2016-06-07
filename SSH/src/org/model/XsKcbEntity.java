package org.model;

import javax.persistence.*;

/**
 * Created by wujiacheng on 16/6/6.
 */
@Entity
@Table(name = "xs_kcb", schema = "stuSys", catalog = "")
@IdClass(XsKcbEntityPK.class)
public class XsKcbEntity {
    private String xh;
    private String kch;

    @Id
    @Column(name = "xh", nullable = false, length = 6)
    public String getXh() {
        return xh;
    }

    public void setXh(String xh) {
        this.xh = xh;
    }

    @Id
    @Column(name = "kch", nullable = false, length = 3)
    public String getKch() {
        return kch;
    }

    public void setKch(String kch) {
        this.kch = kch;
    }

    @Override
    public boolean equals(Object o) {
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;

        XsKcbEntity that = (XsKcbEntity) o;

        if (xh != null ? !xh.equals(that.xh) : that.xh != null) return false;
        if (kch != null ? !kch.equals(that.kch) : that.kch != null) return false;

        return true;
    }

    @Override
    public int hashCode() {
        int result = xh != null ? xh.hashCode() : 0;
        result = 31 * result + (kch != null ? kch.hashCode() : 0);
        return result;
    }
}
