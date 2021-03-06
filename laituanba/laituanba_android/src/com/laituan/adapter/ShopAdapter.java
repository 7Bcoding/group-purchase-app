package com.laituan.adapter;

import java.util.List;

import android.content.Context;
import android.graphics.Bitmap;
import android.util.Log;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.RelativeLayout.LayoutParams;
import android.widget.TextView;

import com.example.laituanba.R;
import com.laituan.adapter.Set_tuanAdapter.Holder;
import com.laituan.info.ShopInfo;
import com.laituan.model.Model;
import com.laituan.utils.LoadImg;
import com.laituan.utils.LoadImg.ImageDownloadCallBack;

/**
 * 商铺列表的适配器
 * @author 苦涩
 *
 */

public class ShopAdapter extends BaseAdapter {

	private List<ShopInfo> list;
	private Context ctx;
	private LoadImg loadImg;

	public ShopAdapter(List<ShopInfo> list, Context ctx) {
		this.list = list;
		this.ctx = ctx;
		// 实例化获取图片的类
		loadImg = new LoadImg(ctx);
	}

	@Override
	public int getCount() {
		// TODO Auto-generated method stub
		return list.size();
	}

	@Override
	public Object getItem(int arg0) {
		// TODO Auto-generated method stub
		return list.get(arg0);
	}

	@Override
	public long getItemId(int arg0) {
		// TODO Auto-generated method stub
		return arg0;
	}

	@Override
	public View getView(final int arg0, View arg1, ViewGroup arg2) {
		final Holder hold;
		
		if (arg1 == null) {
			hold = new Holder();
			//arg1 = View.inflate(ctx, R.layout.item_shop, null);
			arg1 = View.inflate(ctx, R.layout.adapter_listview_cart, null);
			hold.mName = (TextView) arg1.findViewById(R.id.tv_name);
			hold.mNum = (TextView) arg1.findViewById(R.id.tv_num);
			
			hold.mPrice = (TextView) arg1.findViewById(R.id.tv_price);
			hold.mTime = (TextView) arg1.findViewById(R.id.tv_time);
			//hold.cb_choice = (CheckBox) arg1.findViewById(R.id.cb_choice);
			hold.mImage = (ImageView) arg1.findViewById(R.id.tv_adapter_list_pic);
			hold.mAddress = (TextView) arg1.findViewById(R.id.tv_adress);
			arg1.setTag(hold);
		} else {
			hold = (Holder) arg1.getTag();
		}
			/*hold.mTitle = (TextView) arg1.findViewById(R.id.ShopItemTextView);
			hold.mImage = (ImageView) arg1.findViewById(R.id.ShopItemImage);
			hold.mMoney = (TextView) arg1.findViewById(R.id.ShopItemMoney);
			hold.mAddress = (TextView) arg1.findViewById(R.id.ShopItemAddress);
			arg1.setTag(hold);
		} else {
			hold = (Holder) arg1.getTag();
		}*/
		hold.mName.setText(list.get(arg0).getTitle());
		hold.mImage.setTag(Model.SHOPLISTIMGURL + list.get(arg0).getCover_path());
		hold.mPrice.setText("价格："+list.get(arg0).getPrice());
		hold.mNum.setText("数量："+list.get(arg0).getTuan_amount());
		//hold.mAddress.setText("地址："+list.get(arg0).getPosition());
		hold.mAddress.setText("创业大厦");
		hold.mTime.setText("创建时间： "+list.get(arg0).getCreate_time());
		// 设置默认显示的图片
		hold.mImage.setImageResource(R.drawable.shop_photo_frame);
		// 网络获取图片
		Bitmap bit = loadImg.loadImage(hold.mImage, Model.SHOPLISTIMGURL
				+ list.get(arg0).getCover_path(), new ImageDownloadCallBack() {
			@Override
			public void onImageDownload(ImageView imageView, Bitmap bitmap) {
				// 网络交互时回调进来防止错位
				if (hold.mImage.getTag().equals(
						Model.SHOPLISTIMGURL + list.get(arg0).getCover_path())) {
					// 设置网络下载回来图片显示
					hold.mImage.setImageBitmap(bitmap);
				}
			}
		});
		// 从本地获取的
		if (bit != null) {
			// 设置缓存图片显示
			hold.mImage.setImageBitmap(bit);
		}

		return arg1;
	}

	static class Holder {
		/*TextView mTitle, mMoney, mAddress, mStytle;
		ImageView mImage, mStar, mTuan, mQuan, mDing, mCard;*/
		TextView mNum, mPrice, mTime, mName,mAddress;
		ImageView mImage;
	}

}
